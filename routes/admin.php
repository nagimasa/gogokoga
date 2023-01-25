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
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImageGallController;

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
    Route::resource('comments', CommentController::class);
    // Route::resource('menus', MenuController::class);

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


    // ImageGall
    Route::get('admin/imagegalls/index/{id}', [ImageGallController::class, 'index'])->name('imagegalls.index');
    Route::get('admin/imagegalls/create/{id}', [ImageGallController::class, 'create'])->name('imagegalls.create');
    Route::post('admin/imagegalls/store', [ImageGallController::class, 'store'])->name('imagegalls.store');
    Route::get('admin/imagegalls/show/{id}', [ImageGallController::class, 'show'])->name('imagegalls.show');
    Route::get('admin/imagegalls/edit/{id}', [ImageGallController::class, 'edit'])->name('imagegalls.edit');
    Route::post('admin/imagegalls/update/{id}', [ImageGallController::class, 'update'])->name('imagegalls.update');
    Route::delete('admin/imagegalls/delete/{id}', [ImageGallController::class, 'destroy'])->name('imagegalls.destroy');



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
