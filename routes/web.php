<?php

use App\Http\Controllers\Web\Admin\AdminIndexController;
use App\Http\Controllers\Web\Admin\Education\AdminEducationController;
use App\Http\Controllers\Web\Admin\Education\AdminEducationSchoolController;
use App\Http\Controllers\Web\Admin\Olympiad\AdminOlympiadController;
use App\Http\Controllers\Web\Admin\User\AdminUserController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Auth\Verify\EmailVerificationNotificationController;
use App\Http\Controllers\Web\Auth\Verify\EmailVerificationPromptController;
use App\Http\Controllers\Web\Auth\Verify\VerifyEmailController;
use App\Http\Controllers\Web\Olympiad\OlympiadController;
use App\Http\Controllers\Web\Olympiad\OlympiadOrderController;
use App\Http\Controllers\Web\Olympiad\OlympiadResultController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

// Главная страница с редиректом на маршрут олимпиад
Route::get('/', function () {
    return redirect()->route('olympiad.index');
});

// Олимпиады
Route::prefix('/olympiads')->name('olympiad.')->group(function () {
    Route::get('/', [OlympiadController::class, 'index'])->name('index'); // Главная страница

    Route::prefix('/{slug}')->group(function () {
        Route::get('/', [OlympiadController::class, 'show'])->name('show'); // Просмотр конкретной олимпиады
        Route::middleware(['is_auth', 'verified'])->controller(OlympiadOrderController::class)->prefix('/order')->name('order.')->group(function () {
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
    Route::post('/store', 'store')->name('store');
    Route::post('/store-participant', 'storeParticipant')->name('storeParticipant'); // Маршрут для регистрации участника
    Route::post('/store-manager', 'storeManager')->name('storeManager'); // Маршрут для регистрации участника
});

// Аутентификация, Авторизация
Route::controller(LoginController::class)->prefix('/login')->name('login.')->group(function () {
    Route::get('/', 'create')->name('create'); // Страница для входа в систему
    Route::post('/store', 'store')->name('store'); // Маршрут для входа в систему
});

// Верификация email
Route::prefix('/email')->name('verification.')->middleware(['is_auth'])->group(function () {
    Route::get('/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed'])->name('verify');
    Route::get('/verify', EmailVerificationPromptController::class)->name('notice');
    Route::post('/verification-notification', EmailVerificationNotificationController::class)->name('send');
});

// Защищенные маршруты
Route::middleware(['is_auth', 'verified'])->group(function () {
    // Профиль
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index')->middleware(['verified']); // Главная страница профиля
            Route::post('/destroy', 'destroy')->name('destroy'); // Выход из учетной записи пользователя
        });
    });

    // Для администраторов
    Route::middleware(['is_admin'])->prefix('/admin-panel')->name('admin.')->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index'); // Главная страница админ-панели

        // Управление участниками
        Route::controller(AdminUserController::class)->prefix('/users')->name('user.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/edit', 'edit')->name('edit');
        });

        // Учебные справочники
        Route::prefix('/educations')->name('education.')->group(function () {
            Route::get('/', AdminEducationController::class)->name('index');
            // Управление учебными заведениями
            Route::controller(AdminEducationSchoolController::class)->prefix('/schools')->name('school.')->group(function () {
                Route::get('/', 'index')->name('index'); // Просмотр всех учебных заведений
            });
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
    return inertia('Fallback')->with('error', 'Произошла ошибка');
});
