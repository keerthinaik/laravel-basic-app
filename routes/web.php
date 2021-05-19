<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestController;
use App\Models\User;
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

Route::get('/test', [TestController::class, 'index'])->name('test_route_name');

// Category controller
Route::get('category/all', [CategoryController::class, 'all_category'])->name('all.category');
Route::post('category/add', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('category/edit/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('category/update/{id}', [CategoryController::class, 'update_category'])->name('update.category');
Route::get('category/softdelete/{id}', [CategoryController::class, 'softdelete_category'])
    ->name('softdelete.category');
Route::get('category/restore/{id}', [CategoryController::class, 'restore_category'])->name('restore.category');
Route::get('category/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');
