<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
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

// Guest routes (login)
Route::middleware(['guest:admin', 'admin.guest'])->group(function () {
    Route::get('auth/login', [LoginController::class, 'login'])->name('admin-login');
    Route::post('auth/login/check', [LoginController::class, 'check'])->name('admin-check-info');
});

// Protected admin routes
Route::middleware(['auth:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('admin-dashboard-home');
    Route::get('/profile', [AdminsController::class, 'profile'])->name('admin-profile');
    Route::post('/profile/update', [AdminsController::class, 'updateProfile'])->name('update-admin-profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin-logout');

    // Admins Management
    Route::middleware(['can:manage-admins'])->group(function () {
        Route::get('/admins/index', [AdminsController::class, 'admins'])->name('admins-index');
        Route::get('/admins/edit/{id}', [AdminsController::class, 'edit'])->name('edit-admin');
        Route::get('/admins/settings/home', [AdminsController::class, 'settings'])->name('admins-settings-home');
        Route::post('/admins/update/{id}', [AdminsController::class, 'update'])->name('update-admin');
        Route::post('/admins/update-password/{id}', [AdminsController::class, 'updatePassword'])->name('update-admin-password');
        Route::post('/admins/delete', [AdminsController::class, 'destroy'])->name('destroy-admin');
        Route::get('/admins/get-roles/{id}', [AdminsController::class, 'getAdminRoles'])->name('admin-get-roles');
        Route::post('/admins/assign-roles', [AdminsController::class, 'assignRoles'])->name('admin-assign-roles');
    });

    // Settings Management
    Route::middleware(['can:manage-settings'])->group(function () {
        Route::get('/admins/settings/home', [AdminsController::class, 'settings'])->name('admins-settings-home');
        Route::post('/admins/settings/update', [AdminsController::class, 'updateSettings'])->name('admins-settings-update');
    });

    // Roles Management
    Route::middleware(['can:manage-roles'])->group(function () {
        Route::get('/roles', [RolesController::class, 'index'])->name('admin-roles-index');
        Route::get('/roles/create', [RolesController::class, 'create'])->name('admin-roles-create');
        Route::post('/roles/store', [RolesController::class, 'store'])->name('admin-roles-store');
        Route::get('/roles/edit/{role}', [RolesController::class, 'edit'])->name('admin-roles-edit');
        Route::put('/roles/update/{role}', [RolesController::class, 'update'])->name('admin-roles-update');
        Route::delete('/roles/delete/{role}', [RolesController::class, 'destroy'])->name('admin-roles-delete');
    });

    // Permissions Management
    Route::middleware(['can:manage-permissions'])->group(function () {
        Route::get('/permissions', [PermissionsController::class, 'index'])->name('admin-permissions-index');
        Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('admin-permissions-create');
        Route::post('/permissions/store', [PermissionsController::class, 'store'])->name('admin-permissions-store');
        Route::get('/permissions/edit/{permission}', [PermissionsController::class, 'edit'])->name('admin-permissions-edit');
        Route::put('/permissions/update/{permission}', [PermissionsController::class, 'update'])->name('admin-permissions-update');
        Route::delete('/permissions/delete/{permission}', [PermissionsController::class, 'destroy'])->name('admin-permissions-delete');
    });

    // Admin registration (requires special permission)
    Route::middleware(['auth:admin', 'can:register-admins'])->group(function () {
        Route::get('auth/register', [RegisterController::class, 'register'])->name('admin-register');
        Route::post('auth/store', [RegisterController::class, 'store'])->name('admin-store');
    });
});
