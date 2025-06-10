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
use App\Models\Share; // Thêm dòng này
use App\Models\Report; // Thêm dòng này
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
            ->whereDoesntHave('role', function($q) {
                $q->whereRaw("LOWER(name) LIKE ?", ['%quản trị%']);
            })
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

        // Lấy user mới tạo trong 12 tháng gần nhất, group theo tháng
        $recentUsers = User::where('created_at', '>=', now()->subMonths(12))
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($user) {
                return $user->created_at->format('m/Y');
            });

        $postTypes = \App\Models\Post::selectRaw('post_type, COUNT(*) as count')
            ->groupBy('post_type')
            ->get();
        $typeLabels = $postTypes->pluck('post_type');
        $typeCounts = $postTypes->pluck('count');

        // Tỉ lệ bài viết theo trạng thái
        $postStatus = \App\Models\Post::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();
        $statusLabels = $postStatus->pluck('status');
        $statusCounts = $postStatus->pluck('count');

        // Tỉ lệ địa điểm theo loại hình
        $destinationTypes = \App\Models\Destination::selectRaw('travel_type_id, COUNT(*) as count')
            ->groupBy('travel_type_id')
            ->with('travel_types')
            ->get();

        $destinationTypeLabels = $destinationTypes->map(function($item) {
            return optional($item->travel_types)->name ?? 'Không xác định';
        });
        $destinationTypeCounts = $destinationTypes->pluck('count');

        // Lấy tổng số lượt chia sẻ từ database
        $shareCount = Share::count();

        // Lấy tổng số lượt báo cáo từ database
        $reportCount = Report::count();

        return view('admin.overview.overview', compact(
            'userCount', 'postCount', 'destinationCount', 'utilityCount',
            'commentCount', 'likeCount', 'missionCompleted', 'badgeAwarded',
            'topUsers', 'topPosts', 'months', 'monthlyUsers', 'monthlyPosts', 'recentUsers',
            'typeLabels', 'typeCounts', 'statusLabels', 'statusCounts',
            'destinationTypeLabels', 'destinationTypeCounts', 'shareCount',
            'reportCount' // Thêm dòng này
        ));
    }
}
