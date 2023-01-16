<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth:admin'])->name('home');
Route::get('admin/test', [App\Http\Controllers\HomeController::class, 'test'])->middleware(['auth:admin'])->name('test');
Route::get('admin/area', [App\Http\Controllers\iamadmin\HomeController::class, 'area'])->middleware(['auth:admin'])->name('area');


// Route::group(['middleware' => 'Auth'], function(){
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/admin/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
//     Route::get('/admin/area', [App\Http\Controllers\iamadmin\HomeController::class, 'area'])->name('area');
// });
