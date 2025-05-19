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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


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
        $destinations = $query->get();

        // Gắn hình ảnh chính cho từng địa điểm
        foreach ($destinations as $destination) {
            $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
        }

        // Lấy danh sách bài viết mới nhất
        $posts = Post::where('status', 0)
            ->with(['user', 'destination', 'destination.destinationImages'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Trả về view cùng với dữ liệu đã lọc
        return view('user.layout.community', compact(
            'destinations',
            'travelTypes',
            'travelTypeId',
            'province',
            'region',
            'posts'
        ));
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
        $destinations = $query->get();

        // Gắn hình ảnh chính cho từng địa điểm
        foreach ($destinations as $destination) {
            $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
        }

        // Trả về view cùng với dữ liệu đã lọc
        return view('user.layout.explore', compact('destinations', 'travelTypes', 'travelTypeId', 'province', 'region'));
    }


    public function getMission(Request $request)
    {
        // Lấy danh sách nhiệm vụ có trạng thái hoạt động
        $missions = Mission::all();

        // Trả về view cùng với danh sách nhiệm vụ
        return view('user.layout.mission', compact('missions'));
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
}
