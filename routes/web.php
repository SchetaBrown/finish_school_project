<?php

use App\Http\Controllers\Web\Admin\Education\AdminEducationSchoolController;
use App\Http\Controllers\Web\Admin\Olympiad\AdminDirectionController;
use App\Http\Controllers\Web\Admin\Olympiad\AdminOlympiadController;
use App\Http\Controllers\Web\Admin\User\AdminUserController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Olympiad\OlympiadController;
use App\Http\Controllers\Web\Olympiad\OlympiadOrderController;
use App\Http\Controllers\Web\Olympiad\OlympiadResultController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

// Главная страница с редиректом
Route::get('/', function () {
    return redirect()->route('olympiad.index');
});

// Олимпиады
Route::prefix('/olympiads')->name('olympiad.')->group(function () {
    Route::get('/', [OlympiadController::class, 'index'])->name('index'); // Главная страница

    Route::prefix('/{slug}')->group(function () {
        Route::get('/', [OlympiadController::class, 'show'])->name('show'); // Просмотр конкретной олимпиады
        Route::middleware(['is_auth'])->controller(OlympiadOrderController::class)->prefix('/order')->name('order.')->group(function () {
            Route::get('/create', 'create')->name('create'); // Страница для записи на олимпиаду
            Route::post('/store', 'store')->name('store'); // Маршрут для записи на олимпиаду
        });

        // Просмотр результатов олимпиады
        Route::controller(OlympiadResultController::class)->prefix('/results')->name('result.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
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

    // Для администраторов
    Route::middleware(['is_admin'])->prefix('/admin')->name('admin.')->group(function () {

        // Управление направлениями
        Route::controller(AdminDirectionController::class)->prefix('/directions')->name('direction.')->group(function () {
            Route::get('/', 'index')->name('index'); // Все направления
            Route::post('/store', 'store')->name('store'); // Создание нового направления
            Route::patch('/{direction}/update', 'update')->name('update'); // Обновление данных о направлении
        });

        // Управление участниками
        Route::controller(AdminUserController::class)->prefix('/users')->name('user.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        // Управление учебными заведениями
        Route::controller(AdminEducationSchoolController::class)->prefix('/education-schools')->name('school.')->group(function () {
            Route::get('/', 'index')->name('index'); // Просмотр всех учебных заведений
        });

        // Управление олимпиадами
        Route::controller(AdminOlympiadController::class)->prefix('/olympiads')->name('olympiad.')->group(function () {
            Route::get('/', 'index')->name('index'); // Главная страница олимпиад
            Route::get('/create', 'create')->name('create'); // Создание новой олимпиады
            Route::post('/store', 'store')->name('store'); // Маршрут для создания олимпиад
        });
    });
});

// Резервный маршрут
Route::fallback(function () {
    return inertia('Fallback');
});
