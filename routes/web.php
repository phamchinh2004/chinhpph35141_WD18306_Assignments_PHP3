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
    return redirect()->route('userHome.index');
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

Route::get('cart/', [UserController::class, 'cart'])->name('cart');

Route::get('cart/{id}', [UserController::class, 'addToCart'])->name('addToCart');

Route::get('payment', [UserController::class, 'payment'])->name('userPayment');

Route::get('order', [UserController::class, 'order'])->name('userOrder');

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
