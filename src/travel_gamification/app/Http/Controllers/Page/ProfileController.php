<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
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

        return view('user.layout.profile', compact('user', 'posts', 'likedPosts', 'followers', 'followings'));
    }

    public function detail($id)
    {
        $user = \App\Models\User::withCount(['posts', 'likes'])->findOrFail($id);
        // Nếu có điểm (score), truyền thêm
        // Nếu muốn lấy các bài viết của user:
        $posts = $user->posts()->withCount('likes', 'comments')->latest()->get();

        return view('user.layout.detail_user_follow', compact('user', 'posts'));
    }
}
