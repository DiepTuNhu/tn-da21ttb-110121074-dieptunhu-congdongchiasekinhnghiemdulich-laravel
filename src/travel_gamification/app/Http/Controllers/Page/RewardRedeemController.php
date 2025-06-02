<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardRedeemController extends Controller
{
    public function index()
    {
        $rewards = Reward::where('active', 1)->orderByDesc('id')->get();
        $user = Auth::user();
        $history = $user->rewards()->orderByDesc('user_reward.id')->get();
        return view('user.layout.user_reward', compact('rewards', 'user', 'history'));
    }

    public function redeem(Request $request, $id)
    {
        $user = Auth::user();
        $reward = Reward::findOrFail($id);

        // Kiểm tra điều kiện
        if ($user->redeemable_points < $reward->cost_points) {
            return back()->with('error', 'Bạn không đủ điểm để đổi phần thưởng này.');
        }
        if ($reward->stock <= 0) {
            return back()->with('error', 'Phần thưởng đã hết hàng.');
        }
        if (!$reward->active) {
            return back()->with('error', 'Phần thưởng không còn hoạt động.');
        }

        // Nếu là quà hiện vật, validate thông tin nhận hàng
        if ($reward->type == 'physical') {
            $request->validate([
                'receiver_name' => 'required|string|max:255',
                'receiver_phone' => 'required|string|max:20',
                'receiver_address' => 'required|string|max:500',
            ]);
        }

        DB::beginTransaction();
        try {
            // Trừ điểm
            $user->redeemable_points -= $reward->cost_points;
            $user->save();

            // Giảm tồn kho
            $reward->stock -= 1;
            $reward->save();

            // Ghi nhận lịch sử đổi thưởng
            $attachData = [
                'redeemed_at' => now(),
                'delivered' => $reward->type == 'virtual' ? 1 : 0,
            ];
            if ($reward->type == 'physical') {
                $attachData['receiver_name'] = $request->receiver_name;
                $attachData['receiver_phone'] = $request->receiver_phone;
                $attachData['receiver_address'] = $request->receiver_address;
                $attachData['shipping_note'] = $request->shipping_note ?? null;
            }
            $user->rewards()->attach($reward->id, $attachData);

            DB::commit();
            return back()->with('success', 'Đổi thưởng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
