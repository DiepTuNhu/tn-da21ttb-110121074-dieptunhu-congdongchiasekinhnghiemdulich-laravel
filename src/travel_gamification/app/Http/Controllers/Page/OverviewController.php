<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Destination;
use App\Models\Utility;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Mission;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class OverviewController extends Controller
{
    public function index()
    {
        // Thống kê tổng hợp
        $userCount = User::count();
        $postCount = Post::count();
        $destinationCount = Destination::count();
        $utilityCount = Utility::count();
        $commentCount = Comment::count();
        $likeCount = Like::count();
        $missionCompleted = DB::table('user_missions')->where('claimed', 1)->count();
        $badgeAwarded = Mission::whereNotNull('badge_id')->count();

        // Top user tích cực
        $topUsers = User::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        // Top bài viết nhiều like nhất
        $topPosts = Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();

        // Lấy 12 tháng gần nhất
        $months = [];
        $monthlyUsers = [];
        $monthlyPosts = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $months[] = Carbon::now()->subMonths($i)->format('m/Y');
            $monthlyUsers[] = User::whereYear('created_at', substr($month, 0, 4))
                                  ->whereMonth('created_at', substr($month, 5, 2))
                                  ->count();
            $monthlyPosts[] = Post::whereYear('created_at', substr($month, 0, 4))
                                  ->whereMonth('created_at', substr($month, 5, 2))
                                  ->count();
        }

        return view('admin.overview.overview', compact(
            'userCount', 'postCount', 'destinationCount', 'utilityCount',
            'commentCount', 'likeCount', 'missionCompleted', 'badgeAwarded',
            'topUsers', 'topPosts', 'months', 'monthlyUsers', 'monthlyPosts'
        ));
    }
}
