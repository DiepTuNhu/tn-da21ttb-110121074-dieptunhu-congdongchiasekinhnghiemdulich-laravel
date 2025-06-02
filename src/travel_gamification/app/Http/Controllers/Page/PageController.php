<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelType;
use App\Models\Destination;
use App\Models\Mission;
use App\Models\DestinationUtility;
use App\Models\Post;
use App\Models\Slide;
use App\Models\Utility;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;


class PageController extends Controller
{
    // public function index(){
    //     return view('user.index');
    // }
    public function index()
    {
        $slides = Slide::where('status', 0)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        $posts = Post::where('status', 0)
            ->with(['user', 'destination', 'destination.destinationImages'])
            ->whereHas('destination', function ($query) {
                $query->where('status', 0);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(8, ['*'], 'posts_page');
            
        $isLoggedIn = Auth::check();
        // Lấy tất cả các loại hình du lịch từ bảng travel_types
        // Lấy tất cả các điểm đến từ bảng destination


        // $destinations = Destination::with(['destinationImages' => function ($query) {
        //     $query->where('status', 2);
        
        $destinations = Destination::where('status', 0)
            ->with(['destinationImages' => function ($query) {
            $query->where('status', 2);
        }])
            ->orderBy('updated_at', 'desc')
            ->paginate(8, ['*'], 'destinations_page'); // Phân trang bài viết admin

        $isLoggedIn = Auth::check();
        // $travelTypes = TravelType::all();
        $travelTypes = TravelType::where('status', 0)->get();

        return view('user.index', compact('travelTypes', 'destinations', 'posts', 'isLoggedIn', 'slides'));
    }

    public function ajaxFilterPosts(Request $request)
    {
        $typeId = $request->get('type_id');

        $userPosts = Post::where('status', 0)
            ->with('destination')
            ->whereHas('destination', function ($query) use ($typeId) {
                $query->where('travel_type_id', $typeId);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(8); // <-- Dùng paginate

        $adminPosts = Destination::where('status', 0)
            ->with('destinationImages')
            ->where('travel_type_id', $typeId)
            ->orderBy('updated_at', 'desc')
            ->paginate(8); // <-- Dùng paginate

        $userHtml = view('user.layout.partials.user_posts_list', [
            'posts' => $userPosts,
        ])->render();

        $adminHtml = view('user.layout.partials.admin_posts_list', [
            'destinations' => $adminPosts
        ])->render();

        return response()->json([
            'userHtml' => $userHtml,
            'adminHtml' => $adminHtml
        ]);
    }


    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        $keywordNoSign = $this->stripSpecial($this->stripVN($keyword));
        $travelTypeId = $request->input('travel_type_id');

        // Lấy tất cả để lọc lại bằng PHP (nếu dữ liệu lớn thì nên tối ưu lại)
        $destinations = Destination::with(['destinationImages' => function ($query) {
            $query->where('status', 2);
        }])->orderBy('updated_at', 'desc');

        // Nếu chọn loại hình du lịch thì lọc theo loại hình
        if ($travelTypeId) {
            $destinations = $destinations->where('travel_type_id', $travelTypeId);
        }

        $destinations = $destinations->get();

        // Lọc lại bằng PHP cho tìm không dấu, mềm (cho phép sai ký tự đặc biệt)
        if ($keyword) {
            $destinations = $destinations->filter(function($item) use ($keywordNoSign) {
                $nameNoSign = $this->stripSpecial($this->stripVN($item->name));
                $addressNoSign = $this->stripSpecial($this->stripVN($item->address));
                similar_text($nameNoSign, $keywordNoSign, $percentName);
                similar_text($addressNoSign, $keywordNoSign, $percentAddress);
                return strpos($nameNoSign, $keywordNoSign) !== false
                    || strpos($addressNoSign, $keywordNoSign) !== false
                    || $percentName > 60
                    || $percentAddress > 60;
            })->values();
        }

        // Phân trang lại bằng LengthAwarePaginator
        $page = request('destinations_page', 1);
        $perPage = 8;
        $total = $destinations->count();
        $destinations = new \Illuminate\Pagination\LengthAwarePaginator(
            $destinations->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'destinations_page']
        );

        // Phần posts vẫn giữ nguyên như cũ
        $posts = Post::query()
            ->with(['user', 'destination', 'destination.destinationImages'])
            ->whereHas('destination', function ($q) use ($keyword, $travelTypeId) {
                if ($travelTypeId) {
                    $q->where('travel_type_id', $travelTypeId);
                }
                if ($keyword) {
                    $q->where(function($subQ) use ($keyword) {
                        $subQ->where('name', 'like', "%$keyword%")
                             ->orWhereRaw("LOWER(TRIM(SUBSTRING_INDEX(address, ',', -1))) LIKE ?", ['%' . strtolower($keyword) . '%']);
                    });
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(8, ['*'], 'posts_page');

        $slides = Slide::where('status', 0)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        $travelTypes = TravelType::where('status', 0)->get();

        // Lấy danh sách tỉnh/thành từ address (unique)
        $provinces = Destination::selectRaw("TRIM(SUBSTRING_INDEX(address, ',', -1)) as province")
            ->distinct()
            ->pluck('province');

        return view('user.index', compact('travelTypes', 'destinations', 'posts', 'slides', 'provinces'));
    }

    public function getCommunity(Request $request)
    {
        // Lấy danh sách loại hình du lịch
        $travelTypes = TravelType::where('status', 0)->get();

        // Lấy bộ lọc từ request
        $travelTypeId = $request->get('type');
        $province = $request->get('province');
        $region = $request->get('region');
        $destinationId = $request->get('destination_id');

        // Truy vấn địa điểm theo bộ lọc
        $query = Destination::where('status', '!=', 1);

        if ($travelTypeId) {
            $query->where('travel_type_id', $travelTypeId);
        }
        if ($province) {
            $query->where('address', 'LIKE', "%$province%");
        }
        if ($region) {
            $provincesInRegion = $this->getProvincesByRegion($region);
            $query->where(function ($q) use ($provincesInRegion) {
                foreach ($provincesInRegion as $province) {
                    $q->orWhere('address', 'LIKE', "%$province%");
                }
            });
        }

        $destinations = $query->get();

        foreach ($destinations as $destination) {
            $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
        }

        // Lấy danh sách id các địa điểm đã lọc
        $destinationIds = $destinations->pluck('id')->toArray();

        // Lọc bài viết theo các địa điểm đã lọc
        $postsQuery = Post::where('status', 0)
            ->with(['user', 'destination', 'destination.destinationImages']);

        // Nếu chọn 1 địa điểm cụ thể thì chỉ lấy bài viết của địa điểm đó
        if ($destinationId) {
            $postsQuery->where('destination_id', $destinationId);
        } else {
            // Nếu không, lấy bài viết của tất cả địa điểm đã lọc
            $postsQuery->whereIn('destination_id', $destinationIds);
        }
        $posts = $postsQuery->orderBy('updated_at', 'desc')->paginate(12, ['*'], 'page'); // Đổi 'page'

        // Lấy bài viết về tiện ích
        $utilityPostsQuery = Post::where('status', 0)
            ->whereNotNull('utility_id')
            ->with(['user', 'utility']);

        // Lọc theo địa điểm (nếu có)
        if ($destinationId) {
            $utilityIds = DB::table('destination_utilities')
                ->where('destination_id', $destinationId)
                ->pluck('utility_id')
                ->toArray();
            $utilityPostsQuery->whereIn('utility_id', $utilityIds);
        }

        // Lọc theo tỉnh
        if ($province) {
            $utilityPostsQuery->whereHas('utility', function($q) use ($province) {
                $q->where('address', 'LIKE', "%$province%");
            });
        }
        // Lọc theo miền
        if ($region) {
            $provincesInRegion = $this->getProvincesByRegion($region);
            $utilityPostsQuery->whereHas('utility', function($q) use ($provincesInRegion) {
                $q->where(function($subQ) use ($provincesInRegion) {
                    foreach ($provincesInRegion as $province) {
                        $subQ->orWhere('address', 'LIKE', "%$province%");
                    }
                });
            });
        }
        // Lọc theo loại hình tiện ích
        if ($travelTypeId) {
            // Lấy danh sách địa điểm thuộc loại hình du lịch đã chọn
            $destinationIdsByType = \App\Models\Destination::where('travel_type_id', $travelTypeId)->pluck('id')->toArray();
            // Lấy các utility_id liên kết với các địa điểm này
            $utilityIdsByType = DB::table('destination_utilities')
                ->whereIn('destination_id', $destinationIdsByType)
                ->pluck('utility_id')
                ->unique()
                ->toArray();
            // Lọc các bài viết tiện ích theo các utility_id này
            $utilityPostsQuery->whereIn('utility_id', $utilityIdsByType);
        }

        // Lọc theo loại tiện ích (utility_type_id từ request)
        if ($request->filled('utility_type_id')) {
            $utilityPostsQuery->whereHas('utility', function($q) use ($request) {
                $q->where('utility_type_id', $request->utility_type_id);
            });
        }

        $utilityPosts = $utilityPostsQuery
            ->orderBy('updated_at', 'desc')
            ->paginate(12, ['*'], 'utility_page'); // Đổi 'utility_page'

        $allDestinations = Destination::where('status', 0)
            ->with('destinationImages')
            ->get(); // không lọc

        $utilities = \App\Models\Utility::all(); // hoặc with('images') nếu có bảng ảnh riêng

        return view('user.layout.community', [
            'destinations' => $destinations,
            'travelTypes' => $travelTypes,
            'travelTypeId' => $travelTypeId,
            'province' => $province,
            'region' => $region,
            'destinationId' => $destinationId,
            'posts' => $posts,
            'utilityPosts' => $utilityPosts, // <-- Thêm dòng này
            'utilityTypes' => \App\Models\UtilityType::all(),
            'utilities' => $utilities,
            'allDestinations' => $allDestinations,
        ]);
    }
    public function getDetailUtility($id)
    {
        $utility = Utility::with('utility_types', 'nearbyDestinations')->findOrFail($id);

        // Tiện ích liên quan (cùng loại)
        $relatedUtilities = Utility::where('utility_type_id', $utility->utility_type_id)
            ->where('id', '!=', $utility->id)
            ->limit(4)
            ->get();

        // Lấy các địa điểm gần tiện ích này (có thể giới hạn số lượng nếu muốn)
        $nearbyDestinations = $utility->nearbyDestinations()->with('destinationImages')->limit(4)->get();

        return view('user.layout.detail_utility', compact('utility', 'relatedUtilities', 'nearbyDestinations'));
    }
    // Hàm trả về danh sách tỉnh theo miền
    private function getProvincesByRegion($region)
    {
        $regions = [
            'Bắc'=> ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hoà Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
            'Trung'=> ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
            'Nam'=> ['Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
        ];

        return $regions[$region] ?? [];
    }

    public function getExplore (Request $request)
    {
        // Lấy danh sách loại hình du lịch
        $travelTypes = TravelType::where('status', 0)->get();

        // Lấy bộ lọc từ request
        $travelTypeId = $request->get('type');
        $province = $request->get('province');
        $region = $request->get('region'); // Lấy miền từ request

        // Truy vấn cơ bản: chỉ lấy những địa điểm còn hoạt động
        $query = Destination::where('status', '!=', 1)->orderBy('updated_at', 'desc');

        // Lọc theo loại hình du lịch nếu có
        if ($travelTypeId) {
            $query->where('travel_type_id', $travelTypeId);
        }

        // Lọc theo tỉnh nếu có
        if ($province) {
            $query->where('address', 'LIKE', "%$province%");
        }

        // Lọc theo miền nếu có
        if ($region) {
            $provincesInRegion = $this->getProvincesByRegion($region); // Hàm lấy danh sách tỉnh theo miền
            $query->where(function ($q) use ($provincesInRegion) {
                foreach ($provincesInRegion as $province) {
                    $q->orWhere('address', 'LIKE', "%$province%");
                }
            });
        }

        // Lấy dữ liệu sau khi đã áp dụng bộ lọc
        $destinations = $query->paginate(12);

        // Gắn hình ảnh chính cho từng địa điểm
        foreach ($destinations as $destination) {
            $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
        }

        $allDestinations = \App\Models\Destination::select('id', 'name')->orderBy('name')->get();

        // Trả về view cùng với dữ liệu đã lọc
        return view('user.layout.explore', [
            'destinations' => $destinations, // vẫn là phân trang
            'allDestinations' => $allDestinations,
            'travelTypes' => $travelTypes,
            'travelTypeId' => $travelTypeId,
            'province' => $province,
            'region' => $region
        ]);
    }

    public function getRanking(Request $request)
{
    // Trung bình điểm sao toàn hệ thống
    $C = DB::table('ratings')->avg('score');
    $m = 5; // Số lượt đánh giá tối thiểu để "đáng tin" (có thể lấy trung bình hoặc đặt cố định)

    $startOfMonth = now()->startOfMonth();
$endOfMonth = now()->endOfMonth();

$topPosts = \App\Models\Post::with('user')
    ->whereBetween('posts.created_at', [$startOfMonth, $endOfMonth])
    ->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
    ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
    ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
    ->select(
        'posts.id',
        'posts.title',
        'posts.user_id',
        'posts.created_at',
        DB::raw('AVG(ratings.score) as average_rating'),
        DB::raw('COUNT(DISTINCT ratings.id) as rating_count'),
        DB::raw('COUNT(DISTINCT likes.id) as like_count'),
        DB::raw('COUNT(DISTINCT comments.id) as comment_count'),
        DB::raw("((COUNT(DISTINCT ratings.id) / (COUNT(DISTINCT ratings.id) + $m)) * AVG(ratings.score) + ($m / (COUNT(DISTINCT ratings.id) + $m)) * $C) as score")
    )
    ->groupBy('posts.id', 'posts.title', 'posts.user_id', 'posts.created_at')
    ->orderByDesc('score')
    ->orderByDesc('like_count')
    ->orderByDesc('comment_count')
    ->orderByDesc('posts.created_at')
    ->take(10)
    ->get();

    // Top người dùng như cũ
    $topUsers = \App\Models\User::with(['posts.likes'])
        ->orderByDesc('total_points')
        ->take(10)
        ->get();

    return view('user.layout.ranking', compact('topPosts', 'topUsers'));
}
    public function getProfile(Request $request)
    {
        // Trả về view cùng với danh sách nhiệm vụ
        return view('user.layout.profile');
    }

    public function getDetailDestination(Request $request, $id)
    {
        // Lấy thông tin địa điểm
        $destination = Destination::with(['destinationImages' => function ($query) {
            $query->whereIn('status', [0, 2]); // Lấy ảnh có status = 0 hoặc 2
        }])->findOrFail($id);

        // Phân loại ảnh chính và ảnh phụ
        $mainImage = $destination->destinationImages->firstWhere('status', 2); // Ảnh chính
        $subImages = $destination->destinationImages->reject(function ($image) {
            return $image->status == 1; // Loại bỏ ảnh có status = 1
        });

        // Lấy danh sách tiện ích gần địa điểm
        $nearbyUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 30) // Chỉ lấy tiện ích trong bán kính 5km
            ->with('utility') // Lấy thông tin tiện ích qua quan hệ
            ->get();

        // Lấy API Key từ file .env
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');

        // Tạo URL Google Maps
        $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q=" . urlencode($destination->name . ', ' . $destination->address);

        // Lấy tiện ích Ẩm thực (phân trang 8)
        $foodUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 30)
            ->whereHas('utility.utility_types', function($q) {
                $q->where('name', 'Ẩm thực');
            })
            ->with('utility')
            ->orderBy('distance', 'asc') // Sắp xếp theo khoảng cách tăng dần
            ->paginate(8, ['*'], 'food_page');

        // Lấy tiện ích Lưu trú (phân trang 8)
        $stayUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 30)
            ->whereHas('utility.utility_types', function($q) {
                $q->where('name', 'Lưu trú');
            })
            ->with('utility')
            ->orderBy('distance', 'asc') // Sắp xếp theo khoảng cách tăng dần
            ->paginate(8, ['*'], 'stay_page');

        return view('user.layout.detail_destination', compact(
            'destination', 'mainImage', 'subImages', 'mapUrl', 'foodUtilities', 'stayUtilities'
        ));
    }

    public function showDestination($id)
    {
        // Lấy thông tin địa điểm
        $destination = Destination::findOrFail($id);

        // Lấy danh sách tiện ích gần địa điểm
        $nearbyUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 30) // Chỉ lấy tiện ích trong bán kính 5km
            ->with('utility') // Lấy thông tin tiện ích qua quan hệ
            ->get();

        // Truyền dữ liệu sang view
        return view('user.layout.detail_destination', compact('destination', 'nearbyUtilities'));
    }

    public function getMission(Request $request)
    {
        $userId = Auth::id();

        // Reset nhiệm vụ ngày
        $today = now()->toDateString();
        DB::table('user_missions')
            ->join('missions', 'user_missions.mission_id', '=', 'missions.id')
            ->where('user_missions.user_id', $userId)
            ->where('missions.frequency', 'daily')
            ->whereDate('user_missions.updated_at', '<', $today)
            ->update(['claimed' => 0]);

        // Reset nhiệm vụ tuần
        $startOfWeek = now()->copy()->startOfWeek()->toDateString();
        DB::table('user_missions')
            ->join('missions', 'user_missions.mission_id', '=', 'missions.id')
            ->where('user_missions.user_id', $userId)
            ->where('missions.frequency', 'weekly')
            ->whereDate('user_missions.updated_at', '<', $startOfWeek)
            ->update(['claimed' => 0]);

        // Reset nhiệm vụ tháng
        $startOfMonth = now()->copy()->startOfMonth()->toDateString();
        DB::table('user_missions')
            ->join('missions', 'user_missions.mission_id', '=', 'missions.id')
            ->where('user_missions.user_id', $userId)
            ->where('missions.frequency', 'monthly')
            ->whereDate('user_missions.updated_at', '<', $startOfMonth)
            ->update(['claimed' => 0]);

        $userId = Auth::id();
        $missions = Mission::where('status', 0)->get();

        foreach ($missions as $mission) {
            $done = 0;
            $now = now();

            switch ($mission->condition_type) {
                case 'like':
                    $query = \App\Models\Like::where('user_id', $userId)
                        ->whereHas('post', function($q) use ($userId) {
                            $q->where('user_id', '!=', $userId);
                        });
                    break;
                case 'comment':
                    $query = \App\Models\Comment::where('user_id', $userId)
                        ->whereHas('post', function($q) use ($userId) {
                            $q->where('user_id', '!=', $userId);
                        });
                    break;
                case 'post':
                    $query = \App\Models\Post::where('user_id', $userId);
                    break;
                default:
                    $query = null;
            }

            // Lọc theo chu kỳ
            if ($query) {
                if ($mission->frequency === 'daily') {
                    $done = $query->whereDate('created_at', $now->toDateString())->count();
                } elseif ($mission->frequency === 'weekly') {
                    $startOfWeek = $now->copy()->startOfWeek();
                    $endOfWeek = $now->copy()->endOfWeek();
                    $done = $query->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                } elseif ($mission->frequency === 'monthly') {
                    $done = $query->whereYear('created_at', $now->year)
                                  ->whereMonth('created_at', $now->month)
                                  ->count();
                } else {
                    $done = $query->count();
                }
            }

            $mission->progress_done = $done;
            $mission->progress_total = $mission->condition_value ?? 1;
        }

        $dailyMissions = $missions->where('frequency', 'daily');
        $weeklyMissions = $missions->where('frequency', 'weekly');
        $monthlyMissions = $missions->where('frequency', 'monthly');
        $onceMissions = $missions->filter(function($mission) {
            return $mission->frequency === 'once' || is_null($mission->frequency);
        });
        $specialMissions = $missions->where('frequency', 'special')
        ->merge($missions->where('is_special', true)); // nếu có trường is_special

        $claimedMissions = DB::table('user_missions')
            ->where('user_id', Auth::id())
            ->where('claimed', 1)
            ->pluck('mission_id')
            ->toArray();

        return view('user.layout.mission', compact(
            'dailyMissions',
            'weeklyMissions',
            'monthlyMissions',
            'specialMissions',
            'claimedMissions'
        ));
    }

    // public function checkAttendanceStreak($userId, $days = 7)
    // {
    //     $dates = Attendance::where('user_id', $userId)
    //         ->orderByDesc('date')
    //         ->pluck('date')
    //         ->toArray();

    //     if (count($dates) < $days) return false;

    //     $streak = 1;
    //     for ($i = 1; $i < count($dates); $i++) {
    //         $prev = Carbon::parse($dates[$i - 1]);
    //         $curr = Carbon::parse($dates[$i]);
    //         if ($prev->diffInDays($curr) == 1) {
    //             $streak++;
    //             if ($streak == $days) return true;
    //         } else {
    //             $streak = 1;
    //         }
    //     }
    //     return false;
    // }
    public function checkMissionCompletion($userId, $missionId)
    {
        $mission = Mission::find($missionId);

        // Nhiệm vụ đặc biệt: điểm danh liên tiếp
        // if (is_null($mission->condition_type) && $mission->condition_value) {
        //     return $this->checkAttendanceStreak($userId, $mission->condition_value);
        // }

        switch ($mission->condition_type) {
            case 'like':
                // Đếm số lượt like của user (có thể so sánh với condition_value nếu cần)
                $likeCount = \App\Models\Like::where('user_id', $userId)->count();
                return $mission->condition_value ? $likeCount >= $mission->condition_value : $likeCount > 0;

            case 'comment':
                // Chỉ đếm comment của user trên bài viết của người khác
                $commentCount = \App\Models\Comment::where('user_id', $userId)
                    ->whereHas('post', function($q) use ($userId) {
                        $q->where('user_id', '!=', $userId);
                    })
                    ->count();
                return $mission->condition_value ? $commentCount >= $mission->condition_value : $commentCount > 0;

            case 'post':
                // Đếm số bài viết của user
                $postCount = \App\Models\Post::where('user_id', $userId)->count();
                return $mission->condition_value ? $postCount >= $mission->condition_value : $postCount > 0;

            // Thêm các loại nhiệm vụ khác nếu có
            // case 'share': ...
        default:
            return false;
        }

    }

    public function claimMission($id)
    {
        $user = Auth::user();
        $mission = \App\Models\Mission::findOrFail($id);

        // Kiểm tra đã hoàn thành nhiệm vụ chưa (tùy logic của bạn)
        // Ví dụ: $mission->progress_done >= $mission->progress_total

        // Kiểm tra đã nhận thưởng chưa
        $claimed = DB::table('user_missions')
            ->where('user_id', $user->id)
            ->where('mission_id', $mission->id)
            ->where('claimed', 1)
            ->exists();
        if ($claimed) {
            return response()->json(['success' => false, 'message' => 'Bạn đã nhận thưởng nhiệm vụ này rồi!']);
        }

        // Cộng điểm
        $user->total_points += $mission->points_reward;
        $user->redeemable_points += $mission->points_reward;
        $user->save();

        // Đánh dấu đã nhận thưởng
        DB::table('user_missions')->updateOrInsert(
            ['user_id' => $user->id, 'mission_id' => $mission->id],
            ['claimed' => 1, 'updated_at' => now()]
        );

        return response()->json(['success' => true, 'points' => $mission->points_reward]);
    }
    public function like($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        // Không cho tự thích bài của mình
        if ($post->user_id == $user->id) {
            return response()->json([
                'success' => false,
                'error' => 'Bạn không thể tự thích bài viết của mình.'
            ]);
        }

        $liked = $post->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return response()->json([
            'success' => true,
            'liked' => !$liked,
            'like_count' => $post->likes()->count()
        ]);
    }

    private function stripVN($str)
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace([
            '/[àáạảãâầấậẩẫăằắặẳẵ]/u',
            '/[èéẹẻẽêềếệểễ]/u',
            '/[ìíịỉĩ]/u',
            '/[òóọỏõôồốộổỗơờớợởỡ]/u',
            '/[ùúụủũưừứựửữ]/u',
            '/[ỳýỵỷỹ]/u',
            '/[đ]/u'
        ], [
            'a','e','i','o','u','y','d'
        ], $str);
        return $str;
    }
    
    private function stripSpecial($str)
    {
        return preg_replace('/[^a-zA-Z0-9 ]/', '', $str);
    }

    public function ajaxDestinations(Request $request)
    {
        $q = trim($request->input('q'));
        $region = $request->input('region');
        $province = $request->input('province');
        $type = $request->input('type');

        $query = \App\Models\Destination::query();

        if ($q) {
            // Tìm kiếm trên toàn bộ địa điểm, không filter
            $all = $query->select('id', 'name', 'address', 'travel_type_id')->get();
            $qNoSign = $this->stripSpecial($this->stripVN($q));
            $filtered = $all->filter(function($item) use ($qNoSign) {
                $nameNoSign = $this->stripSpecial($this->stripVN($item->name));
                $addressNoSign = $this->stripSpecial($this->stripVN($item->address));
                return strpos($nameNoSign, $qNoSign) !== false
                    || strpos($addressNoSign, $qNoSign) !== false;
            })->take(30);
            $destinations = $filtered->values();
        } else {
            // Không nhập tên, lọc theo filter
            if ($region) {
                $provincesInRegion = $this->getProvincesByRegion($region);
                $query->where(function ($q) use ($provincesInRegion) {
                    foreach ($provincesInRegion as $province) {
                        $q->orWhere('address', 'LIKE', "%$province%");
                    }
                });
            }
            if ($province) {
                $query->where('address', 'like', '%' . $province . '%');
            }
            if ($type) {
                $query->where('travel_type_id', $type);
            }
            $destinations = $query->orderBy('name')->limit(30)->get();
        }

        $results = [];
        foreach ($destinations as $d) {
            $results[] = [
                'id' => $d->id, // Đúng: chỉ trả về ID
                'text' => $d->name,
            ];
        }
        return response()->json(['results' => $results]);
    }
}