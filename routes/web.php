<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'checkLogin']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth','role:user']], function() {
    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::get('/referrals',[UserController::class,'referrals']);
    Route::post('/invites',[UserController::class,'insertInvites']);
});

Route::group(['prefix' => 'admin','middleware' => ['auth','role:admin']], function() {
    Route::get('/dashboard',[AdminController::class,'dashboard']);
    Route::get('/referrals',[AdminController::class,'referrals']);
    Route::get('/referral-info/{id}',[AdminController::class,'referral_info']);
});