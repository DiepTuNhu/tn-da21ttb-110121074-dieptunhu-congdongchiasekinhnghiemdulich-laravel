<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\NewLocationCreated; // Thêm dòng này

class CreateDestinationController extends Controller
{
    public function create(Request $request)
    {
        // Đọc trạng thái từ query hoặc localStorage (bên JS sẽ truyền lên query nếu cần)
        $stepsType = $request->input('stepsType');
        if (!$stepsType) {
            // Nếu không có trên query, thử lấy từ JS (xem bước 3)
            $stepsType = null;
        }
        $step = ($stepsType === 'utility') ? 1 : 1;
        return view('user.layout.create_destination', compact('step', 'stepsType'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Tạo địa điểm mới
            $destination = new \App\Models\Destination();
            $destination->name = $request->name;
            $destination->address = $request->address;
            $destination->highlights = $request->highlights;
            $destination->user_id = Auth::id();
            $destination->status = 'pending';
            $destination->save();

            // Lưu ảnh vào bảng destination_images với status = 2
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $imageName = time() . '-' . $file->getClientOriginalName();
                    $imagePath = $file->storeAs('destination_image', $imageName, 'public');

                    DestinationImage::create([
                        'name' => $imageName,
                        'image_url' => Storage::url($imagePath), // Lưu đường dẫn đầy đủ
                        'status' => 2,
                        'destination_id' => $destination->id,
                    ]);
                }
            }

            // Gửi thông báo cho admin khi có địa điểm mới (chỉ khi user không phải quản trị)
            $userRole = mb_strtolower(Auth::user()->role->name ?? '');
            if ($userRole !== 'quản trị') {
                $admins = User::whereHas('role', function($q) {
                    $q->whereRaw('LOWER(name) = ?', ['quản trị']);
                })->get();
                foreach ($admins as $admin) {
                    $admin->notify(new NewLocationCreated($destination, Auth::user()->username));
                }
            }

            DB::commit();
            // Redirect về trang post_share
            return redirect()->route('page.post_share')->with([
                'success' => 'Tạo địa điểm thành công!',
                'new_destination_id' => $destination->id // Truyền id địa điểm vừa tạo
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
