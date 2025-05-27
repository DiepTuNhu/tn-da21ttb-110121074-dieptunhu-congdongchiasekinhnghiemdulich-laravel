<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('user.layout.community', function ($view) {
            $view->with('isLoggedIn', Auth::check());
        });

        View::composer('admin.index', function ($view) {
            $pendingCount = Post::where('status', 1)->count();
            $view->with('pendingCount', $pendingCount);
        });

        Paginator::useBootstrap();
    }
}
