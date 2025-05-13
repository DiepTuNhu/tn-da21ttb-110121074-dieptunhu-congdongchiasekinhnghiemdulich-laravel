<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelType;
use App\Models\Destination;
use Illuminate\Support\Facades\Http;


class PageController extends Controller
{
    // public function index(){
    //     return view('user.index');
    // }
    public function index()
    {
        // Lấy tất cả các loại hình du lịch từ bảng travel_types
        $travelTypes = TravelType::all();
        // Lấy tất cả các điểm đến từ bảng destination
        // $destinations = Destination::all();
        // Lấy danh sách địa điểm và hình ảnh liên quan
        $destinations = Destination::with(['destinationImages' => function ($query) {
            $query->where('status', 2);
        }])->get();
        

        // Truyền dữ liệu sang view
        return view('user.index', compact('travelTypes', 'destinations'));
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

        // Trả về view cùng với dữ liệu đã lọc
        return view('user.layout.community', compact('destinations', 'travelTypes', 'travelTypeId', 'province', 'region'));
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

}
