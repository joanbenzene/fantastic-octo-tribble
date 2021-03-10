<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking')->middleware('auth');
Route::post('/upload', [App\Http\Controllers\BookingController::class, 'store'])->name('store')->middleware('auth');
Route::post('/payment', [App\Http\Controllers\BookingController::class, 'payement'])->name('pay')->middleware('auth');
Route::get('/link', function () {
    Artisan::call('storage:link');
});
