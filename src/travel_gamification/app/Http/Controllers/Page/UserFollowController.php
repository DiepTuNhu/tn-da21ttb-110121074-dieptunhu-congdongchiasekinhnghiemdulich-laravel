<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserFollowController extends Controller
{
    public function follow(User $user)
    {
        auth()->user()->followings()->syncWithoutDetaching([
            $user->id => ['created_at' => now(), 'updated_at' => now()]
        ]);
        return response()->json(['status' => 'following']);
    }

    public function unfollow(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return response()->json(['status' => 'unfollowed']);
    }
}
