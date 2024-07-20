<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('app.user.home');
})->name('/');

Route::get('login', function () {
    return view('app.login');
})->name('login');

Route::get('register', function () {
    return view('app.register');
})->name('register');

//-----------------------USER-------------------------
Route::get('userHome/', [UserController::class, 'index'])->name('userHome.index');

Route::get('productDetail/{id}', [UserController::class, 'show'])->name('userProductDetail.show');

Route::get('cart/', function () {
    return view('app.user.cart');
})->name('userCart');

Route::get('payment', function () {
    return view('app.user.payment');
})->name('userPayment');

Route::get('order', function () {
    return view('app.user.order');
})->name('userOrder');

Route::get('adminHome', function () {
    return view('app.admin.home');
})->name('adminHome');

//-----------------------ADMIN-------------------------
Route::get('productsManager', function () {
    return view('app.admin.products.index');
})->name('adminProductsMagager');

Route::get('categoriesManager', function () {
    return view('app.admin.products.index');
})->name('adminCategoriesMagager');

Route::get('vouchersManager', function () {
    return view('app.admin.products.index');
})->name('adminVouchersMagager');

Route::get('ordersManager', function () {
    return view('app.admin.products.index');
})->name('adminOrdersMagager');

Route::get('bannersManager', function () {
    return view('app.admin.products.index');
})->name('adminBannersMagager');
