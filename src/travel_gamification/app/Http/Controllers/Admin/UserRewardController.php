<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;

class UserRewardController extends Controller
{
    public function index(Request $request)
    {
        $userRewards = DB::table('user_reward')
            ->join('users', 'user_reward.user_id', '=', 'users.id')
            ->join('rewards', 'user_reward.reward_id', '=', 'rewards.id')
            ->select(
                'user_reward.*',
                'users.username',
                'users.email',
                'rewards.name as reward_name'
            )
            ->orderByDesc('user_reward.id') // Sắp xếp theo id giảm dần
            ->paginate(20);

        return view('admin.reward.list', compact('userRewards'));
    }

    public function updateDelivered(Request $request, $id)
    {
        DB::table('user_reward')->where('id', $id)->update([
            'delivered' => $request->delivered ? 1 : 0,
        ]);
        return back()->with('success', 'Cập nhật trạng thái giao hàng thành công!');
    }
}
