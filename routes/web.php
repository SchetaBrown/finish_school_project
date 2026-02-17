<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', IndexController::class)->name('index');

// Регистрация
Route::controller(RegisterController::class)->prefix('/register')->name('register.')->group(function () {
    Route::get('/', 'create')->name('create'); // Страница для регистрации
    Route::post('/store', 'store')->name('store'); // Маршрут для регистрации
});

// Аутентификация, Авторизация
Route::controller(LoginController::class)->prefix('/login')->name('login.')->group(function () {
    Route::get('/', 'create')->name('create'); // Страница для входа в систему
    Route::post('/store', 'store')->name('store'); // Маршрут для входа в систему
});

// Резервный маршрут
Route::fallback(function() {
    return inertia('Fallback');
});
