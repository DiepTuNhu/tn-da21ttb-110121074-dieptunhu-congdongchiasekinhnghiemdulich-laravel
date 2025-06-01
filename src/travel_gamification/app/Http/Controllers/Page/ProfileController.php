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

        // Lấy các bài viết đã chia sẻ (có pivot is_public, status)
        $sharedPosts = $user->sharedPosts()
            ->with(['likes'])
            ->withPivot('is_public', 'status')
            ->get();

        return view('user.layout.profile', compact(
            'user', 'posts', 'likedPosts', 'followers', 'followings', 'sharedPosts'
        ));
    }

    public function detail($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $posts = $user->posts()->withCount('likes', 'comments')->latest()->get();
        $sharedPosts = $user->sharedPosts()
            ->with(['likes'])
            ->withPivot('is_public', 'status')
            ->get();

        return view('user.layout.detail_user_follow', compact('user', 'posts', 'sharedPosts'));
    }
}
