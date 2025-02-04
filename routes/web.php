<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Frontend\CouponsController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\SystemSettingsController;

Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('on-sale', [FrontendController::class, 'onSale'])->name('on-sale');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('frontendCategory');
Route::get('/categories', [FrontendController::class, 'categories'])->name('frontendCategories');
Route::get('/sub-category/{slug}', [FrontendController::class, 'subcategory'])->name('subcategory');
Route::get('/product/{slug}', [FrontendController::class, 'show'])->name('single-product');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('store-contact');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact-us');

Route::resource('cart', CartController::class);

Route::resource('wishlist', WishlistController::class);
Route::post('coupons', [CouponsController::class, 'store'])->name('coupons.store');
Route::delete('coupons', [CouponsController::class, 'destroy'])->name('coupons.destroy');

// Authenticated users routes
Route::middleware('auth',)->group(function () {
    Route::get('my-orders', [ProfileController::class, 'index'])->name('my-orders.index');
    Route::get('my-profile', [ProfileController::class, 'edit'])->name('my-profile.edit');
    Route::post('my-profile', [ProfileController::class, 'update'])->name('my-profile.store');
    Route::get('my-orders/{id}', [ProfileController::class, 'show'])->name('my-profile.show');
    // Route::resource('orders', OrderController::class);
    Route::resource('checkout', CheckoutController::class);
});

Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/subcategories', SubCategoryController::class);
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/system-settings', SystemSettingsController::class);
    Route::resource('admin/coupon', CouponController::class);
    Route::resource('admin/orders', OrderController::class);
    Route::resource('admin/order-statuses', OrderStatusController::class);
    Route::delete('admin/products/photo/{id}', [ProductController::class, 'destroyImage'])->name('destroyImage');
});
