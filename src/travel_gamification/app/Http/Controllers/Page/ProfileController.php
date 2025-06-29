<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Share;
use App\Models\Like;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->posts_count = $user->posts()->count();
        $user->likes_count = $user->likes()->count();
        $user->missions_count = $user->missions()->count();

        // Lấy danh sách huy hiệu đã nhận (mới nhất trước)
        $claimedMissionIds = DB::table('user_missions')
            ->where('user_id', $user->id)
            ->where('claimed', 1)
            ->orderByDesc('updated_at') // hoặc orderByDesc('id')
            ->pluck('mission_id');

        $badges = \App\Models\Badge::whereIn('id', function($q) use ($claimedMissionIds) {
            $q->select('badge_id')->from('missions')->whereIn('id', $claimedMissionIds);
        })->get();

        // Bài viết của user
        $posts = $user->posts()->withCount('likes', 'comments')->latest()->get();

        // Bài viết user đã like, nhưng không phải của chính họ
        $likedPosts = \App\Models\Post::whereHas('likes', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->where('user_id', '!=', $user->id)
        ->withCount('likes', 'comments')
        ->with(['destination', 'destination.destinationImages'])
        ->latest()
        ->get();

        // Lấy danh sách followers và followings
        $followers = $user->followers()->withPivot('created_at')->get();
        $followings = $user->followings()->withPivot('created_at')->get();

        // Lấy các bài viết đã chia sẻ (có pivot id, is_public, status)
        $sharedPosts = $user->sharedPosts()
            ->with(['likes'])
            ->withPivot('id', 'is_public', 'status')
            ->get();

        return view('user.layout.profile', compact(
            'user', 'badges', 'posts', 'likedPosts', 'followers', 'followings', 'sharedPosts'
        ));
    }

    public function detail($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Đếm số bài viết
        $user->posts_count = $user->posts()->count();

        // Đếm tổng lượt thích nhận được từ tất cả bài viết của user
        $user->likes_count = \App\Models\Like::whereIn('post_id', $user->posts()->pluck('id'))->count();

        // Nếu có cột score trong bảng users thì giữ nguyên, nếu không thì tự tính ở đây
        $user->score = $user->score ?? 0;

        $posts = $user->posts()->withCount('likes', 'comments')->latest()->get();
        $sharedPosts = $user->sharedPosts()
            ->with(['likes'])
            ->withPivot('id','is_public', 'status')
            ->get();
        $followingUsers = $user->followings()->get();
        $followerUsers = $user->followers()->get();

        // Thêm biến đếm
        $following_count = $followingUsers->count();
        $follower_count = $followerUsers->count();

        return view('user.layout.detail_user_follow', compact(
            'user', 'posts', 'sharedPosts', 'followingUsers', 'followerUsers', 'following_count', 'follower_count'
        ));
    }

    public function toggleShareStatus($id)
{
    $share = Share::findOrFail($id);
    if ($share->user_id !== auth()->id()) {
        return response()->json(['status' => 'forbidden'], 403);
    }
    $share->is_public = !$share->is_public;
    $share->save();
    return response()->json(['status' => 'updated']);
}

public function deleteShare($id)
{
    $share = Share::findOrFail($id);
    if ($share->user_id !== auth()->id()) {
        return response()->json(['status' => 'forbidden'], 403);
    }
    $share->delete();
    return response()->json(['status' => 'deleted']);
}
public function setMainBadge(Request $request)
{
    $user = Auth::user();
    $user->main_badge_id = $request->badge_id;
    $user->save();
    return back()->with('success', 'Đã chọn huy hiệu hiển thị!');
}

public function updateProfile(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $user = Auth::user();
    $user->username = $request->username;

    if ($request->hasFile('avatar')) {
        $avatarName = time() . '-' . $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->storeAs('avatars', $avatarName, 'public');
        $user->avatar = $avatarName;
    }

    $user->save();

    // Chuyển hướng về trang profile
    return redirect()->route('page.profile')->with('success', 'Thông tin cá nhân đã được cập nhật.');
}

public function editProfile()
{
    $user = Auth::user();
    return view('user.layout.edit_profile', compact('user'));
}

public function changePassword(Request $request)
{
    try {
        // Validation mật khẩu
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8', // Ít nhất 8 ký tự
                'regex:/[a-z]/', // Ít nhất một chữ cái viết thường
                'regex:/[A-Z]/', // Ít nhất một chữ cái viết hoa
                'regex:/[0-9]/', // Ít nhất một chữ số
                'regex:/[@$!%*?&#]/', // Ít nhất một ký tự đặc biệt
                'confirmed', // Xác nhận mật khẩu
            ],
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            Log::warning('Mật khẩu hiện tại không đúng.', [
                'user_id' => $user->id,
                'current_password' => $request->current_password,
            ]);
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        Log::info('Mật khẩu đã được thay đổi thành công.', [
            'user_id' => $user->id,
        ]);

        // Chuyển hướng về trang profile
        return redirect()->route('page.profile')->with('success', 'Mật khẩu đã được thay đổi.');
    } catch (\Exception $e) {
        Log::error('Lỗi khi đổi mật khẩu.', [
            'error_message' => $e->getMessage(),
            'user_id' => Auth::id(),
        ]);
        return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi, vui lòng thử lại sau.']);
    }
}
public function checkPassword(Request $request)
{
    $user = Auth::user();
    $isValid = Hash::check($request->current_password, $user->password);

    return response()->json(['valid' => $isValid]);
}
}
