<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Owner\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Owner\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Owner\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Owner\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Owner\Auth\NewPasswordController;
use App\Http\Controllers\Owner\Auth\PasswordController;
use App\Http\Controllers\Owner\Auth\PasswordResetLinkController;
use App\Http\Controllers\Owner\Auth\RegisteredUserController;
use App\Http\Controllers\Owner\Auth\VerifyEmailController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\BaseController;
use App\Http\Controllers\Owner\ServiceController;
use App\Http\Controllers\Owner\CommentController;
use App\Http\Controllers\Owner\PhotoGallController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Owner\ReqruitController;
use App\Http\Controllers\Owner\CouponController;
use App\Http\Controllers\Owner\BlogController;

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
    return view('owner.welcome');
});

Route::get('/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth:owners'])->name('dashboard');





Route::middleware('auth:owners')->group(function () {
    // TOPページ
    Route::get('/dashboard', [BaseController::class, 'index'])->name('dashboard');

    Route::resource('services', ServiceController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('reqruits', ReqruitController::class);
    Route::resource('coupons', CouponController::class);
    // Route::resource('blogs', BlogController::class);


    // Blog
    Route::get('blogs/index/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create/', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/show/{blogs}/{detail}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('blogs/edit/{blogs}/{detail}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('blogs/update/{blogs}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/delete/{blogs}/{detail}', [BlogController::class, 'destroy'])->name('blogs.destroy');


    // PhotoGall
    Route::get('photogalls/index/{photogalls}', [PhotoGallController::class, 'index'])->name('photogalls.index');
    Route::get('photogalls/create/{photogalls}', [PhotoGallController::class, 'create'])->name('photogalls.create');
    Route::post('photogalls/store', [PhotoGallController::class, 'store'])->name('photogalls.store');
    Route::get('photogalls/show/{photogalls}', [PhotoGallController::class, 'show'])->name('photogalls.show');
    Route::get('photogalls/edit/{photogalls}/{photo}', [PhotoGallController::class, 'edit'])->name('photogalls.edit');
    Route::post('photogalls/update/{photogalls}', [PhotoGallController::class, 'update'])->name('photogalls.update');
    Route::delete('photogalls/delete/{photogalls}/{photo}', [PhotoGallController::class, 'destroy'])->name('photogalls.destroy');


    // Menu
    // Route::get('menus/index/{menu}', [MenuController::class, 'index'])->name('menus.index');
    Route::get('menus/create/{menu}', [MenuController::class, 'create'])->name('menus.create');
    Route::post('menus/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('menus/show/{menu}', [MenuController::class, 'show'])->name('menus.show');
    Route::get('menus/edit/{menu}/{detail}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('menus/update/{menu}/{detail}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('menus/delete/{menu}/{detail}', [MenuController::class, 'destroy'])->name('menus.destroy');

    
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

Route::middleware('auth:owners')->group(function () {
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
