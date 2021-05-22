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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('personalinformation', \App\Http\Controllers\PersonalInformationController::class);
Route::resource('category', \App\Http\Controllers\CategoryController::class);
Route::resource('blog',\App\Http\Controllers\BlogController::class);
Route::get('checkslug',[\App\Http\Controllers\SlugController::class,'checkSlug'])->name('checkSlug');
Route::get('{username}',[\App\Http\Controllers\MultiBlogController::class,'index'])->name('multiBlog');
Route::get('{username}/information',[\App\Http\Controllers\MultiBlogController::class,'information'])->name('information');
Route::get('{username}/{slug}',[\App\Http\Controllers\MultiBlogController::class,'simpleBlog'])->name('simpleBlog');
