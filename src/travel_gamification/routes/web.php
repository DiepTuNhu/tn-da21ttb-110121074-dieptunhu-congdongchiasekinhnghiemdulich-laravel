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
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictsController;
use App\Http\Controllers\Admin\WardsController;
use App\Http\Controllers\Admin\BadgesController;
use App\Http\Controllers\Admin\MissionsController;
use App\Http\Controllers\Admin\UtilitiesController;
use App\Http\Controllers\Admin\DestinationsController;
use App\Http\Controllers\Admin\DestinationImagesController;

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

// Route::get('/', function () {
//     return view('user.index');
// });

Route::get('/', [PageController::class, 'index'])->name('page.index');

Route::get('/community', [PageController::class, 'getCommunity'])->name('page.community');

//LOGIN
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login/store',[LoginController::class,'store'])->name('login.store');

//REGISTER
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/xulydangky',[RegisterController::class,'postSignup'])->name('postSignup');

//LOGOUT
// Route::post('/page/logout', [AuthController::class, 'logout'])->name('page.logout');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');




// ADMIN=======================================================================================================================================
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
Route::prefix('admin')->group(function () {

//TYPE LOCATION------------------------------------------------------------------------------------------
  Route::get('/travel_types',[TravelTypeController::class,'index'])->name('travel_types.index');
  Route::get('/travel_types/create',[TravelTypeController::class,'create'])->name('travel_types.create');
  Route::post('/travel_types',[TravelTypeController::class,'store'])->name('travel_types.store');
  Route::get('/travel_types/{id}/edit',[TravelTypeController::class,'edit'])->name('travel_types.edit');
  Route::post('/travel_types/{id}',[TravelTypeController::class,'update'])->name('travel_types.update');
  Route::get('/travel_types/{id}',[TravelTypeController::class,'destroy'])->name('travel_types.destroy');


  //TYPE OF UTILITY------------------------------------------------------------------------------------------
  Route::get('/utility_types',[UtilityTypeController::class,'index'])->name('utility_types.index');
  Route::get('/utility_types/create',[UtilityTypeController::class,'create'])->name('utility_types.create');
  Route::post('/utility_types',[UtilityTypeController::class,'store'])->name('utility_types.store');
  Route::get('/utility_types/{id}/edit',[UtilityTypeController::class,'edit'])->name('utility_types.edit');
  Route::post('/utility_types/{id}',[UtilityTypeController::class,'update'])->name('utility_types.update');
  Route::get('/utility_types/{id}',[UtilityTypeController::class,'destroy'])->name('utility_types.destroy');

  //ROLE------------------------------------------------------------------------------------------
  Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
  Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
  Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
  Route::get('/roles/{id}/edit',[RoleController::class,'edit'])->name('roles.edit');
  Route::post('/roles/{id}',[RoleController::class,'update'])->name('roles.update');
  Route::get('/roles/{id}',[RoleController::class,'destroy'])->name('roles.destroy');

  //SLIDE------------------------------------------------------------------------------------------
  Route::get('/slides',[SlideController::class,'index'])->name('slides.index');
  Route::get('/slides/create',[SlideController::class,'create'])->name('slides.create');
  Route::post('/slides',[SlideController::class,'store'])->name('slides.store');
  Route::get('/slides/{id}/edit',[SlideController::class,'edit'])->name('slides.edit');
  Route::post('/slides/{id}',[SlideController::class,'update'])->name('slides.update');
  Route::get('/slides/{id}',[SlideController::class,'destroy'])->name('slides.destroy');

  //USER------------------------------------------------------------------------------------------
  Route::get('/users',[UserController::class,'index'])->name('users.index');
  Route::get('/users/create',[UserController::class,'create'])->name('users.create');
  Route::post('/users',[UserController::class,'store'])->name('users.store');
  Route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
  Route::post('/users/{id}',[UserController::class,'update'])->name('users.update');
  Route::get('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');

  // //PROVINCE------------------------------------------------------------------------------------------
  // Route::get('/provinces',[ProvinceController::class,'index'])->name('provinces.index');
  // Route::get('/provinces/create',[ProvinceController::class,'create'])->name('provinces.create');
  // Route::post('/provinces',[ProvinceController::class,'store'])->name('provinces.store');
  // Route::get('/provinces/{id}/edit',[ProvinceController::class,'edit'])->name('provinces.edit');
  // Route::post('/provinces/{id}',[ProvinceController::class,'update'])->name('provinces.update');
  // Route::get('/provinces/{id}',[ProvinceController::class,'destroy'])->name('provinces.destroy');

  // //DISTRICT------------------------------------------------------------------------------------------
  // Route::get('/districts',[DistrictsController::class,'index'])->name('districts.index');
  // Route::get('/districts/create',[DistrictsController::class,'create'])->name('districts.create');
  // Route::post('/districts',[DistrictsController::class,'store'])->name('districts.store');
  // Route::get('/districts/{id}/edit',[DistrictsController::class,'edit'])->name('districts.edit');
  // Route::post('/districts/{id}',[DistrictsController::class,'update'])->name('districts.update');
  // Route::get('/districts/{id}',[DistrictsController::class,'destroy'])->name('districts.destroy');

  // //WARD------------------------------------------------------------------------------------------
  // Route::get('/wards',[WardsController::class,'index'])->name('wards.index');
  // Route::get('/wards/create',[WardsController::class,'create'])->name('wards.create');
  // Route::post('/wards',[WardsController::class,'store'])->name('wards.store');
  // Route::get('/wards/{id}/edit',[WardsController::class,'edit'])->name('wards.edit');
  // Route::post('/wards/{id}',[WardsController::class,'update'])->name('wards.update');
  // Route::get('/wards/{id}',[WardsController::class,'destroy'])->name('wards.destroy');

  //BADGE------------------------------------------------------------------------------------------
  Route::get('/badges',[BadgesController::class,'index'])->name('badges.index');
  Route::get('/badges/create',[BadgesController::class,'create'])->name('badges.create');
  Route::post('/badges',[BadgesController::class,'store'])->name('badges.store');
  Route::get('/badges/{id}/edit',[BadgesController::class,'edit'])->name('badges.edit');
  Route::post('/badges/{id}',[BadgesController::class,'update'])->name('badges.update');
  Route::get('/badges/{id}',[BadgesController::class,'destroy'])->name('badges.destroy');

  //MISSION------------------------------------------------------------------------------------------
  Route::get('/missions',[MissionsController::class,'index'])->name('missions.index');
  Route::get('/missions/create',[MissionsController::class,'create'])->name('missions.create');
  Route::post('/missions',[MissionsController::class,'store'])->name('missions.store');
  Route::get('/missions/{id}/edit',[MissionsController::class,'edit'])->name('missions.edit');
  Route::post('/missions/{id}',[MissionsController::class,'update'])->name('missions.update');
  Route::get('/missions/{id}',[MissionsController::class,'destroy'])->name('missions.destroy');

  //UTILITY------------------------------------------------------------------------------------------
  Route::get('/utilities',[UtilitiesController::class,'index'])->name('utilities.index');
  Route::get('/utilities/create',[UtilitiesController::class,'create'])->name('utilities.create');
  Route::post('/utilities',[UtilitiesController::class,'store'])->name('utilities.store');
  Route::get('/utilities/{id}/edit',[UtilitiesController::class,'edit'])->name('utilities.edit');
  Route::post('/utilities/{id}',[UtilitiesController::class,'update'])->name('utilities.update');
  Route::get('/utilities/{id}',[UtilitiesController::class,'destroy'])->name('utilities.destroy');

  //DESTINATION------------------------------------------------------------------------------------------
  Route::get('/destinations',[DestinationsController::class,'index'])->name('destinations.index');
  Route::get('/destinations/create',[DestinationsController::class,'create'])->name('destinations.create');
  Route::post('/destinations',[DestinationsController::class,'store'])->name('destinations.store');
  Route::get('/destinations/{id}/edit',[DestinationsController::class,'edit'])->name('destinations.edit');
  Route::post('/destinations/{id}',[DestinationsController::class,'update'])->name('destinations.update');
  Route::get('/destinations/{id}',[DestinationsController::class,'destroy'])->name('destinations.destroy');

  //DESTINATION IMAGE------------------------------------------------------------------------------------------
  Route::get('/destination_images',[DestinationImagesController::class,'index'])->name('destination_images.index');
  Route::get('/destination_images/create',[DestinationImagesController::class,'create'])->name('destination_images.create');
  Route::post('/destination_images',[DestinationImagesController::class,'store'])->name('destination_images.store');
  Route::get('/destination_images/{id}/edit',[DestinationImagesController::class,'edit'])->name('destination_images.edit');
  Route::post('/destination_images/{id}',[DestinationImagesController::class,'update'])->name('destination_images.update');
  Route::get('/destination_images/{id}',[DestinationImagesController::class,'destroy'])->name('destination_images.destroy');
  
});

