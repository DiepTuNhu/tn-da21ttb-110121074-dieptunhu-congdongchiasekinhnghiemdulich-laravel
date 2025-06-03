<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Share;
use App\Models\Like;
use App\Models\Mission;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->posts_count = $user->posts()->count();
        $user->likes_count = $user->likes()->count();
        $user->missions_count = $user->missions()->count();

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
            'user', 'posts', 'likedPosts', 'followers', 'followings', 'sharedPosts'
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
}
