<?php

use App\Http\Controllers\ProfileController;
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


use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\DriveController;
use App\Http\Controllers\User\ContactController;
// use App\Http\Controllers\User\TaxiController;



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

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/search', [UserController::class, 'search'])->name('search');

Route::get('/category/{category}', [UserController::class, 'category'])->name('category');
Route::get('/reqruit', [UserController::class, 'reqruit'])->name('reqruit');
Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');

Route::get('/blog/{service}', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{service}/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/drive/{category}', [DriveController::class, 'index'])->name('drive');
Route::get('/drive/detail/{id}', [DriveController::class, 'detail'])->name('d-detail');


Route::get('aboutus', [UserController::class, 'aboutus'])->name('aboutus');
Route::get('rule', [UserController::class, 'rule'])->name('rule');


// 問い合わせフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
//確認ページ
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
//送信完了ページ
Route::post('/contact/thanks', [ContactController::class, 'send'])->name('contact.send');


// Route::get('/taxi/{service}', [TaxiController::class, 'index'])->name('taxi.index');
// Route::get('/taxi/{service}/{detail}', [TaxiController::class, 'show'])->name('taxi.show');






Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

// Route::middleware('auth:users')->group(function(){
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/admin/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
//     Route::get('/admin/area', [App\Http\Controllers\iamadmin\HomeController::class, 'area'])->name('area');
// });

Route::middleware('auth:user')->group(function () {
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



require __DIR__.'/auth.php';
