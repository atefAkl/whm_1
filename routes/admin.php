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


// Protected admin routes
Route::middleware(['auth:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('admin-dashboard-home');
    // Profile Management
    Route::get('/profile',                  [AdminsController::class, 'profile'])->name('admin-profile');
    Route::put('/profile/update',           [AdminsController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/profile/password',         [AdminsController::class, 'updatePassword'])->name('admin.password.update');
    Route::put('/profile/settings',         [AdminsController::class, 'updateSettings'])->name('admin.settings.update');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin-logout');

    // Admins Management
    Route::middleware(['can:manage-admins'])->group(function () {
        Route::get('/admins', [AdminsController::class, 'index'])->name('admins-index');
        Route::get('/admins/create', [RegisterController::class, 'register'])->name('admins-create');
        Route::post('/admins', [AdminsController::class, 'store'])->name('admins-store');
        Route::get('/admins/{id}/edit', [AdminsController::class, 'edit'])->name('admins-edit');
        Route::put('/admins/update/{id}', [AdminsController::class, 'update'])->name('admins-update');
        Route::delete('/admins/delete/{id}', [AdminsController::class, 'destroy'])->name('admins-destroy');
        Route::post('/admins/assign/roles/{id}', [AdminsController::class, 'dassignRoles'])->name('admin-assign-roles');
        Route::put('/admins/{id}/toggle-status', [AdminsController::class, 'toggleStatus'])->name('admins-toggle-status');
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
        Route::delete('/roles/destroy/{role}', [RolesController::class, 'destroy'])->name('admin-roles-destroy');
    });

    // Permissions Management
    Route::middleware(['can:manage-permissions'])->group(function () {
        Route::get('/permissions', [PermissionsController::class, 'index'])->name('admin-permissions-index');
        Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('admin-permissions-create');
        Route::get('/permissions/getById/{id}', [PermissionsController::class, 'getById'])->name('admin-permissions-getById');
        Route::post('/permissions/store', [PermissionsController::class, 'store'])->name('admin-permissions-store');
        Route::get('/permissions/edit/{permission}', [PermissionsController::class, 'edit'])->name('admin-permissions-edit');
        Route::put('/permissions/update/{permission}', [PermissionsController::class, 'update'])->name('admin-permissions-update');
        Route::delete('/permissions/delete/{permission}', [PermissionsController::class, 'destroy'])->name('admin-permissions-destroy');
    });


    Route::get('/logs/all', [AdminLogController::class, 'show'])
        ->name('admin-logs')
        ->middleware('can:view-system-logs');

    Route::get('/logs/{file}', [AdminLogController::class, 'show'])
        ->name('admin-log-view')
        ->middleware('can:view-system-logs');
});
