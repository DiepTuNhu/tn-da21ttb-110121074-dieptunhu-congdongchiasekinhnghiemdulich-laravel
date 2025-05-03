<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\AuthController;

use App\Http\Controllers\Admin\TravelTypeController;
use App\Http\Controllers\Admin\UtilityTypeController;
use App\Http\Controllers\Admin\RoleController;


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

//LOGIN
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login/store',[LoginController::class,'store'])->name('login.store');

//REGISTER
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/xulydangky',[RegisterController::class,'postSignup'])->name('postSignup');

//LOGOUT
// Route::post('/page/logout', [AuthController::class, 'logout'])->name('page.logout');



// ADMIN=======================================================================================================================================


Route::prefix('admin')->group(function () {
//TYPE LOCATION------------------------------------------------------------------------------------------
  Route::get('/travel_types',[TravelTypeController::class,'index'])->name('travel_types.index');
  Route::get('/travel_types/create',[TravelTypeController::class,'create'])->name('travel_types.create');
  Route::post('/travel_types',[TravelTypeController::class,'store'])->name('travel_types.store');
  Route::get('/travel_types/{id}/edit',[TravelTypeController::class,'edit'])->name('travel_types.edit');
  Route::post('/travel_types/{id}',[TravelTypeController::class,'update'])->name('travel_types.update');
  Route::get('/travel_types/{id}',[TravelTypeController::class,'destroy'])->name('travel_types.destroy');


  //TYPE OF UTILITY
  Route::get('/utility_types',[UtilityTypeController::class,'index'])->name('utility_types.index');
  Route::get('/utility_types/create',[UtilityTypeController::class,'create'])->name('utility_types.create');
  Route::post('/utility_types',[UtilityTypeController::class,'store'])->name('utility_types.store');
  Route::get('/utility_types/{id}/edit',[UtilityTypeController::class,'edit'])->name('utility_types.edit');
  Route::post('/utility_types/{id}',[UtilityTypeController::class,'update'])->name('utility_types.update');
  Route::get('/utility_types/{id}',[UtilityTypeController::class,'destroy'])->name('utility_types.destroy');

  //ROLE
  Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
  Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
  Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
  Route::get('/roles/{id}/edit',[RoleController::class,'edit'])->name('roles.edit');
  Route::post('/roles/{id}',[RoleController::class,'update'])->name('roles.update');
  Route::get('/roles/{id}',[RoleController::class,'destroy'])->name('roles.destroy');
});
