<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\VerifyEmailContrller;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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
    Route::middleware(['isAdminOrStaff'])->group(function () {
        Route::get('adminHome', function () {
            return view('app.admin.home');
        })->name('adminHome');

        Route::get('productsManager', [ProductController::class, 'index'])->name('productsManagerIndex');
        Route::get('productsManager/create', [ProductController::class, 'create'])->name('createProduct')->middleware('isAdmin');
        Route::post('productsManager', [ProductController::class, 'createTemporary'])->name('createProductTemporary')->middleware('isAdmin');
        Route::get('productsManager/edit/{id}', [ProductController::class, 'edit'])->name('editProduct')->middleware('isAdmin');
        Route::patch('productsManager/edit/{id}', [ProductController::class, 'update'])->name('updateProduct')->middleware('isAdmin');
        Route::delete('productsManager/{id}', [ProductController::class, 'destroy'])->name('deleteProduct')->middleware('isAdmin');

        Route::get('bannersManager', [BannerController::class, 'index'])->name('bannersManagerIndex');
        Route::get('bannersManager/create', [BannerController::class, 'create'])->name('createBanner')->middleware('isAdmin');
        Route::post('bannersManager', [BannerController::class, 'store'])->name('storeBanner')->middleware('isAdmin');
        Route::get('bannersManager/edit/{id}', [BannerController::class, 'edit'])->name('editBanner')->middleware('isAdmin');
        Route::delete('bannersManager/deleteBanner/{id}', [BannerController::class, 'destroy'])->name('deleteBanner')->middleware('isAdmin');
        Route::patch('bannersManager/updateStatus/{id}', [BannerController::class, 'updateStatus'])->name('updateStatusBanner')->middleware('isAdmin');

        Route::get('vouchersManager', [VoucherController::class, 'index'])->name('vouchersManagerIndex');
        Route::get('vouchersManager/create', [VoucherController::class, 'create'])->name('createVoucher')->middleware('isAdmin');
        Route::post('vouchersManager', [VoucherController::class, 'store'])->name('storeVoucher')->middleware('isAdmin');
        Route::get('vouchersManager/edit/{id}', [VoucherController::class, 'edit'])->name('editVoucher')->middleware('isAdmin');
        Route::patch('vouchersManager/update/{id}', [VoucherController::class, 'update'])->name('updateVoucher')->middleware('isAdmin');
        Route::delete('vouchersManager/deleteVoucher/{id}', [VoucherController::class, 'destroy'])->name('deleteVoucher')->middleware('isAdmin');
        Route::patch('vouchersManager/updateStatus/{id}', [VoucherController::class, 'updateStatus'])->name('updateStatusVoucher')->middleware('isAdmin');

        Route::get('ordersManager', [OrderController::class, 'index'])->name('ordersManagerIndex');
        Route::get('ordersManager/edit/{id}', [OrderController::class, 'edit'])->name('editOrder')->middleware('isAdmin');
        Route::patch('ordersManager/update/{id}', [OrderController::class, 'update'])->name('updateOrder')->middleware('isAdmin');
        Route::patch('ordersManager/updateStatus/{id}', [OrderController::class, 'updateStatus'])->name('updateStatusOrder')->middleware('isAdmin');
    });
});
