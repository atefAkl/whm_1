<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('admin-dashboard-home')->middleware('auth:admin');


Route::get('auth/login',                    [LoginController::class, 'login'])->name('admin-login');
Route::post('auth/login/check',             [LoginController::class, 'check'])->name('admin-check-info');
Route::get('auth/register',                 [RegisterController::class, 'register'])->name('admin-register');
Route::post('auth/store',                   [RegisterController::class, 'store'])->name('admin-store');
