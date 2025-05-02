<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\AuthController;

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