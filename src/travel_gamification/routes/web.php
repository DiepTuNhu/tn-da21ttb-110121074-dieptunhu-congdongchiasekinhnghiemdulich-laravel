<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CKEditorController;

use App\Http\Controllers\Admin\TravelTypeController;
use App\Http\Controllers\Admin\UtilityTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BadgesController;
use App\Http\Controllers\Admin\MissionsController;
use App\Http\Controllers\Admin\UtilitiesController;
use App\Http\Controllers\Admin\DestinationsController;
use App\Http\Controllers\Admin\DestinationImagesController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\UserRewardController;

use App\Http\Controllers\Page\PostController;
use App\Http\Controllers\Page\ProfileController;
use App\Http\Controllers\Page\CreateDestinationController;
use App\Http\Controllers\Page\CreateUtilityController;
use App\Http\Controllers\Page\UserFollowController;
use App\Http\Controllers\Page\RewardRedeemController;
use App\Http\Controllers\Page\NotificationActionController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Follow người dùng
Route::post('/user/{id}/follow-user', [NotificationActionController::class, 'followUser'])->middleware('auth');

// Unfollow người dùng (nếu có)
Route::post('/user/{id}/unfollow-user', [NotificationActionController::class, 'unfollowUser'])->middleware('auth');

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::get('/search', [PageController::class, 'search'])->name('user.search');


Route::get('/community', [PageController::class, 'getCommunity'])->name('page.community');

Route::get('/community/post-share', [PostController::class, 'showPostShare'])->name('page.post_share');
Route::get('/community/post-articles', [PostController::class, 'create'])->name('post_articles');
Route::post('/community/post-articles', [PostController::class, 'store'])->name('post_articles.store');
Route::get('/community/post-articles/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::post('/community/post-articles/{id}/update', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.delete');

Route::post('/post/{id}/like', [PostController::class, 'like'])->middleware('auth')->name('post.like');
Route::post('/post/{id}/comment', [PostController::class, 'comment'])->middleware('auth')->name('post.comment');
Route::post('/post/{id}/report', [PostController::class, 'reportPost'])->middleware('auth')->name('post.report');
Route::get('/ajax/filter-posts', [PageController::class, 'ajaxFilterPosts'])->name('filter.posts.by.traveltype');
Route::get('/ajax/filter-destinations', [PageController::class, 'ajaxFilterDestinations'])->name('filter.destinations.by.traveltype');


Route::get('/explore', [PageController::class, 'getExplore'])->name('page.explore');
Route::get('/ajax/destinations', [PageController::class, 'ajaxDestinations'])->name('ajax.destinations');
Route::get('/destination/{id}', [PageController::class, 'getDetailDestination'])->name('destination.detail');

Route::get('/ajax/post-share-destinations', [PostController::class, 'ajaxDestinations'])->name('ajax.post_share_destinations');
Route::get('/ajax/post-share-utilities', [PostController::class, 'ajaxUtilities'])->name('ajax.post_share_utilities');
Route::get('post_articles/{id}', [PostController::class, 'postArticles'])->name('post_articles');
Route::get('/mission', [PageController::class, 'getMission'])->name('page.mission');
Route::post('/missions/claim/{id}', [PageController::class, 'claimMission'])->name('missions.claim');

Route::post('/user/set-main-badge', [ProfileController::class, 'setMainBadge'])->name('user.set-main-badge');
Route::get('/ranking', [PageController::class, 'getRanking'])->name('page.ranking');
Route::get('/profile', [PageController::class, 'getProfile'])->name('page.profile');
Route::get('/profile', [ProfileController::class, 'show'])->name('page.profile')->middleware('auth');
Route::get('/user/{id}/detail', [ProfileController::class, 'detail'])->name('detail_user_follow');
Route::post('/user/share/{id}/toggle', [ProfileController::class, 'toggleShareStatus'])->middleware('auth');
Route::post('/user/share/{id}/delete', [ProfileController::class, 'deleteShare'])->middleware('auth');

Route::get('/post/{id}', [PostController::class, 'showDetailPost'])->name('post.detail');
Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');
Route::post('/comments/like/{id}', [PostController::class, 'likeComment'])->name('comments.like');
Route::post('comments/update/{id}', [PostController::class, 'updateComment'])->name('comments.update');
Route::post('/comments/delete/{id}', [PostController::class, 'deleteComment'])->name('comments.delete');
Route::post('/posts/{id}/rate', [PostController::class, 'rate'])->name('posts.rating');
Route::post('/posts/report/{id}', [\App\Http\Controllers\Page\PostController::class, 'reportPost'])->name('posts.report');
Route::post('/comments/report/{id}', [\App\Http\Controllers\Page\PostController::class, 'reportComment'])->name('comments.report');

Route::post('/post/{post}/share', [PostController::class, 'share'])->name('post.share')->middleware('auth');
Route::post('/user/destination/store', [CreateDestinationController::class, 'store'])->name('user.destination.store');
Route::get('/user/destination/create', [CreateDestinationController::class, 'create'])->name('user.destination.create');
// Route::get('/user/destination/create', function() {
//     return view('user.layout.create_destination');
// })->name('user.destination.create');

Route::middleware('auth')->group(function () {
    Route::get('/rewards', [RewardRedeemController::class, 'index'])->name('user.rewards');
    Route::post('/rewards/redeem/{id}', [RewardRedeemController::class, 'redeem'])->name('user.redeem_reward');
});

Route::get('/utility/create', [CreateUtilityController::class, 'create'])->name('user.utility.create');
Route::post('/utility/store', [CreateUtilityController::class, 'store'])->name('user.utility.store');
Route::get('/utility/{id}', [PageController::class, 'getDetailUtility'])->name('utility.detail');

//LOGIN
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login/store',[LoginController::class,'store'])->name('login.store');

Route::post('/notifications/mark-as-read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) $notification->markAsRead();
    return response()->json(['success' => true]);
})->name('notifications.markSingleAsRead');

Route::post('/notifications/mark-as-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAsRead');

Route::post('/user/{user}/follow', [UserFollowController::class, 'follow'])->name('user.follow');
Route::post('/user/{user}/unfollow', [UserFollowController::class, 'unfollow'])->name('user.unfollow');


//REGISTER
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/xulydangky',[RegisterController::class,'postSignup'])->name('postSignup');

//LOGOUT
// Route::post('/page/logout', [AuthController::class, 'logout'])->name('page.logout');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// Route::get('auth/google', [App\Http\Controllers\User\LoginController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('auth/google/callback', [App\Http\Controllers\User\LoginController::class, 'handleGoogleCallback']);

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/admin/notification/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    // Chuyển hướng đến trang phù hợp, ví dụ:
    $data = $notification->data;
    if (($data['type'] ?? '') === 'utility') {
        return redirect()->route('utilities.index', ['highlight' => $data['utility_id']]);
    }
    return redirect()->route('destinations.index', ['highlight' => $data['location_id']]);
})->name('admin.notification.read');
// ADMIN=======================================================================================================================================
Route::get('admin/overview', [\App\Http\Controllers\Page\OverviewController::class, 'index'])->name('admin.overview');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/posts/pending', [\App\Http\Controllers\Admin\PostController::class, 'pending'])->name('admin.posts.pending');
    Route::post('/posts/{id}/approve', [\App\Http\Controllers\Admin\PostController::class, 'approve'])->name('admin.posts.approve');
});
Route::get('/admin/posts/pending', [\App\Http\Controllers\Admin\PostController::class, 'pending'])->name('admin.posts.pending');
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
Route::prefix('admin')->group(function () {

//TYPE DESTINATION------------------------------------------------------------------------------------------
  Route::get('/travel_types',[TravelTypeController::class,'index'])->name('travel_types.index');
  Route::get('/travel_types/create',[TravelTypeController::class,'create'])->name('travel_types.create');
  Route::post('/travel_types',[TravelTypeController::class,'store'])->name('travel_types.store');
  Route::get('/travel_types/{id}/edit',[TravelTypeController::class,'edit'])->name('travel_types.edit');
  Route::post('/travel_types/{id}',[TravelTypeController::class,'update'])->name('travel_types.update');
  Route::get('/travel_types/{id}',[TravelTypeController::class,'destroy'])->name('travel_types.destroy');
  Route::get('admin/travel-types/{id}', [TravelTypeController::class, 'show'])->name('travel_types.show');


  //TYPE OF UTILITY------------------------------------------------------------------------------------------
  Route::get('/utility_types',[UtilityTypeController::class,'index'])->name('utility_types.index');
  Route::get('/utility_types/create',[UtilityTypeController::class,'create'])->name('utility_types.create');
  Route::post('/utility_types',[UtilityTypeController::class,'store'])->name('utility_types.store');
  Route::get('/utility_types/{id}/edit',[UtilityTypeController::class,'edit'])->name('utility_types.edit');
  Route::post('/utility_types/{id}',[UtilityTypeController::class,'update'])->name('utility_types.update');
  Route::delete('/utility_types/{id}',[UtilityTypeController::class,'destroy'])->name('utility_types.destroy');
  Route::get('admin/utility-types/{id}', [UtilityTypeController::class, 'show'])->name('utility_types.show');

  //ROLE------------------------------------------------------------------------------------------
  Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
  Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
  Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
  Route::get('/roles/{id}/edit',[RoleController::class,'edit'])->name('roles.edit');
  Route::post('/roles/{id}',[RoleController::class,'update'])->name('roles.update');
  Route::delete('/roles/{id}',[RoleController::class,'destroy'])->name('roles.destroy');

  //SLIDE------------------------------------------------------------------------------------------
  Route::get('/slides',[SlideController::class,'index'])->name('slides.index');
  Route::get('/slides/create',[SlideController::class,'create'])->name('slides.create');
  Route::post('/slides',[SlideController::class,'store'])->name('slides.store');
  Route::get('/slides/{id}/edit',[SlideController::class,'edit'])->name('slides.edit');
  Route::post('/slides/{id}',[SlideController::class,'update'])->name('slides.update');
  Route::delete('/slides/{id}',[SlideController::class,'destroy'])->name('slides.destroy');

  //USER------------------------------------------------------------------------------------------
  Route::get('/users',[UserController::class,'index'])->name('users.index');
  Route::get('/users/create',[UserController::class,'create'])->name('users.create');
  Route::post('/users',[UserController::class,'store'])->name('users.store');
  Route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
  Route::post('/users/{id}',[UserController::class,'update'])->name('users.update');
  Route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');

  //BADGE------------------------------------------------------------------------------------------
  Route::get('/badges',[BadgesController::class,'index'])->name('badges.index');
  Route::get('/badges/create',[BadgesController::class,'create'])->name('badges.create');
  Route::post('/badges',[BadgesController::class,'store'])->name('badges.store');
  Route::get('/badges/{id}/edit',[BadgesController::class,'edit'])->name('badges.edit');
  Route::post('/badges/{id}',[BadgesController::class,'update'])->name('badges.update');
  Route::delete('/badges/{id}',[BadgesController::class,'destroy'])->name('badges.destroy');
  Route::get('admin/badges/{id}', [BadgesController::class, 'show'])->name('badges.show');

  //MISSION------------------------------------------------------------------------------------------
  Route::get('/missions',[MissionsController::class,'index'])->name('missions.index');
  Route::get('/missions/create',[MissionsController::class,'create'])->name('missions.create');
  Route::post('/missions',[MissionsController::class,'store'])->name('missions.store');
  Route::get('/missions/{id}/edit',[MissionsController::class,'edit'])->name('missions.edit');
  Route::post('/missions/{id}',[MissionsController::class,'update'])->name('missions.update');
  Route::delete('/missions/{id}',[MissionsController::class,'destroy'])->name('missions.destroy');
  Route::get('admin/missions/{id}', [MissionsController::class, 'show'])->name('missions.show');

  //UTILITY------------------------------------------------------------------------------------------
  Route::get('/utilities',[UtilitiesController::class,'index'])->name('utilities.index');
  Route::get('/utilities/create',[UtilitiesController::class,'create'])->name('utilities.create');
  Route::post('/utilities',[UtilitiesController::class,'store'])->name('utilities.store');
  Route::get('/utilities/{id}/edit',[UtilitiesController::class,'edit'])->name('utilities.edit');
  Route::post('/utilities/{id}',[UtilitiesController::class,'update'])->name('utilities.update');
  Route::delete('/utilities/{id}',[UtilitiesController::class,'destroy'])->name('utilities.destroy');
  Route::get('admin/utilities/{id}', [UtilitiesController::class, 'show'])->name('utilities.show');

  //DESTINATION------------------------------------------------------------------------------------------
  Route::get('/destinations',[DestinationsController::class,'index'])->name('destinations.index');
  Route::get('/destinations/create',[DestinationsController::class,'create'])->name('destinations.create');
  Route::post('/destinations',[DestinationsController::class,'store'])->name('destinations.store');
  Route::get('/destinations/{id}/edit',[DestinationsController::class,'edit'])->name('destinations.edit');
  Route::post('/destinations/{id}',[DestinationsController::class,'update'])->name('destinations.update');
  Route::delete('/destinations/{id}',[DestinationsController::class,'destroy'])->name('destinations.destroy');
  Route::get('/destinations/{id}', [DestinationsController::class, 'showDetail'])->name('destinations.show');

  //DESTINATION IMAGE------------------------------------------------------------------------------------------
  Route::get('/destination_images',[DestinationImagesController::class,'index'])->name('destination_images.index');
  Route::get('/destination_images/create',[DestinationImagesController::class,'create'])->name('destination_images.create');
  Route::post('/destination_images',[DestinationImagesController::class,'store'])->name('destination_images.store');
  Route::get('/destination_images/{id}/edit',[DestinationImagesController::class,'edit'])->name('destination_images.edit');
  Route::post('/destination_images/{id}',[DestinationImagesController::class,'update'])->name('destination_images.update');
  Route::delete('/destination_images/{id}',[DestinationImagesController::class,'destroy'])->name('destination_images.destroy');
  
  // POST-------------------------------------------------------------------------------------------------
  Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('posts.index');
  Route::post('/posts/{id}/toggle-status', [App\Http\Controllers\Admin\PostController::class, 'toggleStatus'])->name('admin.posts.toggleStatus');
  Route::delete('/posts/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');
  Route::get('/posts/{id}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.posts.show');

  // COMMENT-------------------------------------------------------------------------------------------------
  Route::get('/comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
  Route::post('/reviews/{id}/toggle-status', [App\Http\Controllers\Admin\CommentController::class, 'toggleStatus'])->name('reviews.toggleStatus');
  Route::delete('/reviews/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('reviews.destroy');
  Route::get('admin/reviews/{id}', [App\Http\Controllers\Admin\CommentController::class, 'show'])->name('reviews.show');

  Route::get('user-rewards', [UserRewardController::class, 'index'])->name('admin.user_rewards.index');
  Route::post('user-rewards/{id}/delivered', [UserRewardController::class, 'updateDelivered'])->name('admin.user_rewards.updateDelivered');
});


// Route::get('admin/rewards/{id}', [RewardController::class, 'show'])->name('rewards.show');
Route::prefix('admin/rewards')->name('rewards.')->group(function () {
    Route::get('/', [RewardController::class, 'index'])->name('index');
    Route::get('/create', [RewardController::class, 'create'])->name('create');
    Route::post('/store', [RewardController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RewardController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RewardController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [RewardController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [RewardController::class, 'show'])->name('show');
    
});

Route::get('/after-login', function() {
    $intended = session('url.intended') ?? url('/');
    return redirect($intended);
})->name('after.login');
