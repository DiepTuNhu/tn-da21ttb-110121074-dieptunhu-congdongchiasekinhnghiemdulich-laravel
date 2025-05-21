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
            ->get();

        $adminPosts = Destination::where('status', 0)
            ->with('destinationImages')
            ->where('travel_type_id', $typeId)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Render riêng 2 phần HTML
        $userHtml = view('user.layout.partials.user_posts_list', [
            'posts' => $userPosts, // truyền đúng tên biến
        ])->render();

        $adminHtml = view('user.layout.partials.admin_posts_list', [
            'destinations' => $adminPosts // 👈 Phải đúng tên
        ])->render();
        return response()->json([
            'userHtml' => $userHtml,
            'adminHtml' => $adminHtml
        ]);
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $destinations = Destination::query();
        if ($keyword) {
            $destinations->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                  ->orWhereRaw("LOWER(TRIM(SUBSTRING_INDEX(address, ',', -1))) LIKE ?", ['%' . strtolower($keyword) . '%']);
            });
        }
        $destinations = $destinations
            ->with(['destinationImages' => function ($query) {
                $query->where('status', 2);
            }])
            ->orderBy('updated_at', 'desc')
            ->paginate(8, ['*'], 'destinations_page');

        $posts = Post::query()
            ->with(['user', 'destination', 'destination.destinationImages'])
            ->whereHas('destination', function ($q) use ($keyword) {
                if ($keyword) {
                    $q->where('name', 'like', "%$keyword%")
                      ->orWhereRaw("LOWER(TRIM(SUBSTRING_INDEX(address, ',', -1))) LIKE ?", ['%' . strtolower($keyword) . '%']);
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

        $posts = $postsQuery->orderBy('updated_at', 'desc')->paginate(12); // hoặc số lượng bạn muốn

        return view('user.layout.community', compact(
            'destinations',
            'travelTypes',
            'travelTypeId',
            'province',
            'region',
            'destinationId',
            'posts'
        ));
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
            'Bắc' => ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hòa Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
            'Trung' => ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
            'Nam' => ['TP Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
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
        $query = Destination::where('status', '!=', 1);

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

        // Trả về view cùng với dữ liệu đã lọc
        return view('user.layout.explore', compact('destinations', 'travelTypes', 'travelTypeId', 'province', 'region'));
    }

    public function getRanking(Request $request)
    {
        // Trả về view cùng với danh sách nhiệm vụ
        return view('user.layout.ranking');
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
            ->where('distance', '<=', 5) // Chỉ lấy tiện ích trong bán kính 5km
            ->with('utility') // Lấy thông tin tiện ích qua quan hệ
            ->get();

        // Lấy API Key từ file .env
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');

        // Tạo URL Google Maps
        $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q=" . urlencode($destination->name . ', ' . $destination->address);
    // Phân loại tiện ích theo loại
        $foodUtilities = $nearbyUtilities->filter(function ($utility) {
            return $utility->utility->utility_types->name === 'Ẩm thực'; // So sánh theo tên loại
        });

        $stayUtilities = $nearbyUtilities->filter(function ($utility) {
            return $utility->utility->utility_types->name === 'Lưu trú'; // So sánh theo tên loại
        });
        // Trả về view cùng với dữ liệu
        return view('user.layout.detail_destination', compact('destination', 'mainImage', 'subImages', 'mapUrl', 'foodUtilities', 'stayUtilities'));
    }

    public function showDestination($id)
    {
        // Lấy thông tin địa điểm
        $destination = Destination::findOrFail($id);

        // Lấy danh sách tiện ích gần địa điểm
        $nearbyUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 5) // Chỉ lấy tiện ích trong bán kính 5km
            ->with('utility') // Lấy thông tin tiện ích qua quan hệ
            ->get();

        // Truyền dữ liệu sang view
        return view('user.layout.detail_destination', compact('destination', 'nearbyUtilities'));
    }

    public function getMission(Request $request)
    {
        $userId = Auth::id();
        $missions = Mission::where('status', 0)->get();

        // Thêm tiến độ cho từng nhiệm vụ
        foreach ($missions as $mission) {
            switch ($mission->condition_type) {
                case 'like':
                    $done = \App\Models\Like::where('user_id', $userId)->count();
                    break;
                case 'comment':
                    $done = \App\Models\Comment::where('user_id', $userId)->count();
                    break;
                case 'post':
                    $done = \App\Models\Post::where('user_id', $userId)->count();
                    break;
                default:
                    $done = 0;
            }
            $mission->progress_done = $done;
            $mission->progress_total = $mission->condition_value ?? 1;
        }

        $dailyMissions = $missions->where('frequency', 'daily');
        $weeklyMissions = $missions->where('frequency', 'weekly');
        $monthlyMissions = $missions->where('frequency', 'monthly');
        // Nhiệm vụ đặc biệt: frequency = 'once' hoặc null
        $onceMissions = $missions->filter(function($mission) {
            return $mission->frequency === 'once' || is_null($mission->frequency);
        });

        // Trả về view cùng với danh sách nhiệm vụ đã phân loại
        return view('user.layout.mission', compact('dailyMissions', 'weeklyMissions', 'monthlyMissions', 'onceMissions'));
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
                // Đếm số lượt comment của user
                $commentCount = \App\Models\Comment::where('user_id', $userId)->count();
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
    public function like($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $liked = $post->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return response()->json([
            'liked' => !$liked,
            'count' => $post->likes()->count()
        ]);
    }
}