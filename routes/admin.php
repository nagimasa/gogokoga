<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;


use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PhotoGallController;
use App\Http\Controllers\Admin\ReqruitController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\AddAreaController;

use App\Http\Controllers\ProfileController;
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
    return view('admin.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('dashboard');


Route::middleware('auth:admin')->group(function () {
    Route::resource('areas', AreasController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('tags', TagController::class);
    Route::resource('addareas', AddAreaController::class);
    // Route::resource('menus', MenuController::class);

    // Service
    Route::get('admin/services/search/', [ServiceController::class, 'search'])->name('services.search');



    // Reqruit
    Route::get('admin/owners/index/{id}', [OwnerController::class, 'index'])->name('owners.index');
    Route::get('admin/owners/create/{id}', [OwnerController::class, 'create'])->name('owners.create');
    Route::post('admin/owners/store', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('admin/owners/show/{id}', [OwnerController::class, 'show'])->name('owners.show');
    Route::get('admin/owners/edit/{id}', [OwnerController::class, 'edit'])->name('owners.edit');
    Route::post('admin/owners/update/{id}', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('admin/owners/delete/{id}', [OwnerController::class, 'destroy'])->name('owners.destroy');


    
    // Comment
    Route::get('admin/comments/index/{id}',     [CommentController::class, 'index'])->name('mencommentsus.index');
    Route::get('admin/comments/create/{id}',    [CommentController::class, 'create'])->name('comments.create');
    Route::post('admin/comments/store',         [CommentController::class, 'store'])->name('comments.store');
    Route::get('admin/comments/show/{id}',      [CommentController::class, 'show'])->name('comments.show');
    Route::get('admin/comments/edit/{id}',      [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('admin/comments/update/{id}',   [CommentController::class, 'update'])->name('comments.update');
    Route::delete('admin/comments/delete/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


    // Reqruit
    Route::get('admin/reqruits/index/{id}', [ReqruitController::class, 'index'])->name('reqruits.index');
    Route::get('admin/reqruits/create/{id}', [ReqruitController::class, 'create'])->name('reqruits.create');
    Route::post('admin/reqruits/store', [ReqruitController::class, 'store'])->name('reqruits.store');
    Route::get('admin/reqruits/show/{id}', [ReqruitController::class, 'show'])->name('reqruits.show');
    Route::get('admin/reqruits/edit/{id}', [ReqruitController::class, 'edit'])->name('reqruits.edit');
    Route::post('admin/reqruits/update/{id}', [ReqruitController::class, 'update'])->name('reqruits.update');
    Route::delete('admin/reqruits/delete/{id}', [ReqruitController::class, 'destroy'])->name('reqruits.destroy');


    // Coupon
    Route::get('admin/coupons/index/{id}', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('admin/coupons/create/{id}', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('admin/coupons/store', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('admin/coupons/show/{id}', [CouponController::class, 'show'])->name('coupons.show');
    Route::get('admin/coupons/edit/{id}', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::post('admin/coupons/update/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('admin/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');


    // Menu
    Route::get('admin/menus/index/{id}', [MenuController::class, 'index'])->name('menus.index');
    Route::get('admin/menus/create/{id}', [MenuController::class, 'create'])->name('menus.create');
    Route::post('admin/menus/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('admin/menus/show/{id}', [MenuController::class, 'show'])->name('menus.show');
    Route::get('admin/menus/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('admin/menus/update/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('admin/menus/delete/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');


    // Blog
    Route::get('admin/blogs/index/{id}', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('admin/blogs/create/{id}', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('admin/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('admin/blogs/show/{id}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('admin/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('admin/blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('admin/blogs/delete/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


    // PhotoGall
    Route::get('admin/photogalls/index/{id}', [PhotoGallController::class, 'index'])->name('photogalls.index');
    Route::get('admin/photogalls/create/{id}', [PhotoGallController::class, 'create'])->name('photogalls.create');
    Route::post('admin/photogalls/store', [PhotoGallController::class, 'store'])->name('photogalls.store');
    Route::get('admin/photogalls/show/{id}', [PhotoGallController::class, 'show'])->name('photogalls.show');
    Route::get('admin/photogalls/edit/{id}', [PhotoGallController::class, 'edit'])->name('photogalls.edit');
    Route::post('admin/photogalls/update/{id}', [PhotoGallController::class, 'update'])->name('photogalls.update');
    Route::delete('admin/photogalls/delete/{id}', [PhotoGallController::class, 'destroy'])->name('photogalls.destroy');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});




Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
