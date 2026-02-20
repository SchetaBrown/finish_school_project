<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Olympiad\OlympiadController;
use App\Http\Controllers\Web\Olympiad\OrderController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

// Главная страница с редиректом
Route::get('/', function () {
    return redirect()->route('olympiad.index');
});

// Олимпиады
Route::controller(OlympiadController::class)->prefix('/olympiads')->name('olympiad.')->group(function () {
    Route::get('/', 'index')->name('index'); // Главная страница
    Route::get('/{olympiad}', 'show')->name('show'); // Просмотр конкретной олимпиады
});

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

// Защищенные маршруты
Route::middleware(['is_auth'])->group(function () {
    // Профиль
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index'); // Главная страница профиля
        });
    });

    // Запись на олимпиаду
    Route::controller(OrderController::class)->prefix('/')->name('order')->group(function () {
        Route::get('/', 'create')->name('create'); // Страница для записи на олимпиаду
    });
});

// Резервный маршрут
Route::fallback(function () {
    return inertia('Fallback');
});
