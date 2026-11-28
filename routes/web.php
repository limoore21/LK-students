<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';
require __DIR__.'/survey-and-suggestions.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Профиль курсанта (только просмотр)
Route::get('/profile', function () {
    return view('profile.show');
})->middleware('auth')->name('profile.show');

// Загрузка аватарки
Route::get('/avatar/upload', function () {
    return view('avatar.upload');
})->middleware('auth')->name('avatar.upload');

Route::post('/avatar/upload', [App\Http\Controllers\AvatarController::class, 'store'])
    ->middleware('auth')
    ->name('avatar.store');


// Модерация аватарок (только для старшины)
Route::get('/sergeant/avatars', [App\Http\Controllers\Sergeant\AvatarModerationController::class, 'index'])
    ->name('sergeant.avatars.index');

Route::post('/sergeant/avatars/{user}/approve', [App\Http\Controllers\Sergeant\AvatarModerationController::class, 'approve'])
    ->name('sergeant.avatars.approve');

Route::post('/sergeant/avatars/{user}/reject', [App\Http\Controllers\Sergeant\AvatarModerationController::class, 'reject'])
    ->name('sergeant.avatars.reject');


// Панель куратора (только для curator и admin)
Route::get('/curator/students', [App\Http\Controllers\Curator\StudentProfileController::class, 'index'])
    ->middleware('auth')
    ->name('curator.students.index');

Route::get('/curator/students/{user}/edit', [App\Http\Controllers\Curator\StudentProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('curator.students.edit');

Route::put('/curator/students/{user}', [App\Http\Controllers\Curator\StudentProfileController::class, 'update'])
    ->middleware('auth')
    ->name('curator.students.update');
