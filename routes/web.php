<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Curator\StudentProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sergeant\AvatarModerationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    Route::middleware('role:curator')->prefix('curator')->group(function () {
        Route::get('/students', [StudentProfileController::class, 'index'])->name('curator.students.index');
        Route::get('/students/{user}/edit', [StudentProfileController::class, 'edit'])->name('curator.students.edit');
        Route::put('/students/{user}', [StudentProfileController::class, 'update'])->name('curator.students.update');
    });

    Route::middleware('role:sergeant')->prefix('sergeant')->group(function () {
        Route::get('/avatars', [AvatarModerationController::class, 'index'])->name('sergeant.avatars.index');
        Route::post('/avatars/{user}/approve', [AvatarModerationController::class, 'approve'])->name('sergeant.avatars.approve');
        Route::post('/avatars/{user}/reject', [AvatarModerationController::class, 'reject'])->name('sergeant.avatars.reject');
    });
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});