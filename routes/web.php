<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/create_reserve', [HomeController::class, "create_reserve"])->name("create_reserve");

Route::post('/pay', [PaymentController::class, "redirectToGateway"])->name("pay");
Route::get('/pay/callback', [PaymentController::class, 'handleGatewayCallback'])->name('handleGateway');

Route::get('/pay/{id}', [App\Http\Controllers\HomeController::class, 'show_pay'])->name('show_pay');

Route::get('/review', [HomeController::class, 'review'])->name('review');


//admin route
Route::get('/admin', [AdminController::class, "index"])->name('admin');
