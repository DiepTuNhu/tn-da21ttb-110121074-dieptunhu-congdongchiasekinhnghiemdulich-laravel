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
        $travelTypeId = $request->get('type'); // Lọc theo loại hình

        // Lọc các địa điểm
        $query = Destination::where('status', '!=', 1);

        if ($travelTypeId) {
            $query->where('travel_type_id', $travelTypeId); // Sử dụng travel_type_id
        }

        $destinations = $query->get();

        // Gắn hình ảnh chính cho các địa điểm
        foreach ($destinations as $destination) {
            $destination->mainImage = $destination->destinationImages()->where('status', 2)->first();
        }

        // Trả về dữ liệu nếu yêu cầu là AJAX
        if ($request->wantsJson()) {
            return response()->json([
                'destinations' => $destinations,
            ]);
        }

        // Trả về view nếu không phải AJAX
        return view('user.layout.community', compact('destinations', 'travelTypes'));
    }
}
