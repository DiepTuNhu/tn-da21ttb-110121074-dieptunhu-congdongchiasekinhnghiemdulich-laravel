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

    // Truy vấn cơ bản: chỉ lấy những địa điểm còn hoạt động
    $query = Destination::where('status', '!=', 1);

    // Lọc theo loại hình du lịch nếu có
    if ($travelTypeId) {
        $query->where('travel_type_id', $travelTypeId);
    }

    // Lọc theo tỉnh nếu có
    if ($province) {
        // So sánh chứa tên tỉnh trong chuỗi địa chỉ
        $query->where('address', 'LIKE', "%$province%");
    }

    // Lấy dữ liệu sau khi đã áp dụng bộ lọc
    $destinations = $query->get();

    // Gắn hình ảnh chính cho từng địa điểm
    foreach ($destinations as $destination) {
        $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
    }

    // Trả về view cùng với dữ liệu đã lọc
    return view('user.layout.community', compact('destinations', 'travelTypes'));
}

}
