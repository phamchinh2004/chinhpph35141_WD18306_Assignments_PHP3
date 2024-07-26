<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailContrller;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminMiddleware;
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
    // return view('welcome');
})->name('/');

//-----------------------LOGIN-REGISTER-LOGOUT-------------------------
Route::get('auth/login', [LoginController::class,'index'])->name('login');
Route::post('auth/login', [LoginController::class,'login'])->name('login');
Route::get('auth/logout', [LoginController::class,'logout'])->name('logout');

Route::get('register', [RegisterController::class,'index'])->name('register');
Route::post('auth/register', [RegisterController::class,'register'])->name('register.post');

//-----------------------VERIFY_EMAIL-------------------------
Route::get('auth/verify/{token}',[VerifyEmailContrller::class,'verify'])->name('verify.email');

//--------------------------------USER----------------------------------
Route::get('userHome/', [UserController::class, 'index'])->name('userHome.index');

Route::get('productDetail/{id}', [UserController::class, 'show'])->name('userProductDetail.show');
Route::post('productDetail/', [UserController::class, 'updateInformationProduct'])->name('userProductDetailFocused.show');

Route::get('cart/', [UserController::class, 'cart'])->name('cart');

Route::get('cart/{id}', [UserController::class, 'addToCart'])->name('addToCart');

Route::get('payment', [UserController::class, 'payment'])->name('userPayment');

Route::get('order', [UserController::class, 'order'])->name('userOrder');

Route::get('adminHome', function () {
    return view('app.admin.home');
})->name('adminHome');

//-------------------------------ADMIN----------------------------------
// Route::get('admin',function(){
//     return 'ADMIN';
// })->middleware(CheckAdminMiddleware::class);

// Route::get('admin',function(){
//     return 'ADMIN';
// })->middleware('isAdmin');

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
