<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/',[WebController::class,'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function() {

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/userlist', [AdminController::class, 'userList'])
            ->name('userlist');

        Route::get('/activateuser/{id}', [AdminController::class, 'activateUser'])
            ->name('activateuser');

        Route::get('/inactivateuser/{id}', [AdminController::class, 'inactivateUser'])
            ->name('inactivateuser');
});

Route::prefix('merchant')->middleware('auth')->group(function() {
    Route::get('/dashboard',[MerchantController::class,'index'])
        ->name('merchant.dashboard');

    Route::get('/createorder',[MerchantController::class,'createOrder'])
        ->name('createorder');

    Route::post('/storeorder',[MerchantController::class,'storeOrder'])
        ->name('storeorder');
});

Route::prefix('rider')->middleware('auth')->group(function() {
    Route::get('/dashboard',[RiderController::class,'index'])
        ->name('rider.dashboard');
});

Route::prefix('/auth')->group(function() {

    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/registerpost', [AuthController::class, 'register_post'])
        ->name('registerpost');

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/loginpost', [LoginController::class, 'login'])
        ->name('loginpost');

});

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
