<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/reset-password/{id}', [AdminController::class, 'resetPasswordForm'])->name('reset_password_form');
Route::post('/admin/reset/{id}', [AdminController::class, 'reset'])->name('reset');
Route::get('/admin/change-activity/{id}', [AdminController::class, 'changeActivity'])->name('activity');
