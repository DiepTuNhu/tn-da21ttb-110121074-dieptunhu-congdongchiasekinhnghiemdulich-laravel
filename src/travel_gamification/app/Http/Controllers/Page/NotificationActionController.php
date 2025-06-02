<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostLikedNotification;
use App\Notifications\PostCommentedNotification;
use App\Notifications\UserFollowedNotification;

class NotificationActionController extends Controller
{
    public function like(Post $post)
    {
        // Kiểm tra đã like chưa
        $user = auth()->user();
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->create(['user_id' => $user->id]);
            if ($post->user_id != $user->id) {
                $post->user->notify(new \App\Notifications\PostLikedNotification($post, $user));
            }
        }
        return response()->json(['status' => 'liked']);
    }

    public function comment(Request $request, Post $post)
    {
        $user = auth()->user();
        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content')
        ]);
        if ($post->user_id != $user->id) {
            $post->user->notify(new \App\Notifications\PostCommentedNotification($post, $user));
        }
        return response()->json(['status' => 'commented']);
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->syncWithoutDetaching([
            $user->id => ['created_at' => now(), 'updated_at' => now()]
        ]);
        if ($user->id != $follower->id) {
            $user->notify(new \App\Notifications\UserFollowedNotification($follower));
        }
        return response()->json(['status' => 'following']);
    }

    public function unfollow(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return response()->json(['status' => 'unfollowed']);
    }
}
