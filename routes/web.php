<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestController;
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

// Test Route
Route::get('/test', [TestController::class, 'index'])->name('test_route_name');

// Dashboard Route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// Category routes
Route::get('category/all', [CategoryController::class, 'all_category'])->name('all.category');
Route::post('category/add', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('category/edit/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('category/update/{id}', [CategoryController::class, 'update_category'])->name('update.category');
Route::get('category/softdelete/{id}', [CategoryController::class, 'softdelete_category'])
    ->name('softdelete.category');
Route::get('category/restore/{id}', [CategoryController::class, 'restore_category'])->name('restore.category');
Route::get('category/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete.category');

// Brand routes
Route::get('brand/all', [BrandController::class, 'all_brand'])->name('all.brand');
Route::post('brand/add', [BrandController::class, 'add_brand'])->name('add.brand');
Route::get('brand/edit/{id}', [BrandController::class, 'edit_brand'])->name('edit.brand');
Route::post('brand/update/{id}', [BrandController::class, 'update_brand'])->name('update.brand');
Route::get('brand/delete/{id}', [BrandController::class, 'delete_brand'])->name('delete.brand');

// Multipic routes
Route::get('multi/pic', [BrandController::class, 'multi_pic'])->name('multi.pic');
Route::post('multi/pic/add', [BrandController::class, 'add_multi_pic'])->name('add.images');

// email verification route
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('user/logout', [TestController::class, 'logout'])->name('user.logout');
