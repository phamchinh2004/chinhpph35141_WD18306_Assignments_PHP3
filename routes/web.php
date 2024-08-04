<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\VerifyEmailContrller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminMiddleware;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect()->route('userHome.index');
})->name('/');

//-----------------------LOGIN-REGISTER-LOGOUT-------------------------
Route::get('auth/login', [LoginController::class, 'index'])->name('login');
Route::post('auth/login', [LoginController::class, 'login'])->name('login');
Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('auth/register', [RegisterController::class, 'register'])->name('register.post');

//-----------------------VERIFY_EMAIL-------------------------
Route::get('auth/verify/{id}/{token}', [VerificationController::class, 'verify'])->name('verify.email');
Route::get('notificationEmail', [VerificationController::class, 'show'])->name('notificationEmail');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

//--------------------------------USER----------------------------------
Route::get('userHome/', [UserController::class, 'index'])->name('userHome.index');

Route::get('productDetail/{id}', [UserController::class, 'show'])->name('userProductDetail.show');

Route::post('productDetail/', [UserController::class, 'updateInformationProduct'])->name('userProductDetailFocused');

//--------------------------------MIDDLEWARE----------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    //--------------------------------USER----------------------------------
    //---------------------CART---------------------
    Route::get('cart/', [UserController::class, 'cart'])->name('cart');

    Route::get('cart/{variant_id}/{quantity}', [UserController::class, 'addToCart'])->name('addToCart');

    Route::post('cart/', [UserController::class, 'updateCart'])->name('updateCart');

    Route::delete('cart/', [UserController::class, 'destroyCart'])->name('destroyCart');

    //---------------------PAYMENT---------------------
    Route::get('payment/{items}', [UserController::class, 'payment'])->name('payment');

    Route::post('order', [UserController::class, 'order'])->name('order');

    Route::get('orderDetail/{order_id}', [UserController::class, 'orderDetail'])->name('orderDetail');

    //-------------------------------ADMIN----------------------------------
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('adminHome', function () {
            return view('app.admin.home');
        })->name('adminHome');

        Route::get('productsManager', [ProductController::class, 'index'])->name('productsManagerIndex');
        Route::get('productsManager/create', [ProductController::class, 'create'])->name('createProduct');
        Route::post('productsManager/create/temporary', [ProductController::class, 'createTemporary'])->name('createProductTemporary');
        Route::delete('productsManager/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');

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
    });
});
