<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\Olympiad\EducationManagerMiddleware;
use App\Http\Middleware\Olympiad\OlympiadManagerMiddleware;
use App\Http\Middleware\ParticipantMiddleware;
use App\Http\Middleware\ShareRecaptchaKeyMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is_auth' => AuthMiddleware::class,
            'is_admin' => AdminMiddleware::class,
            'is_participant' => ParticipantMiddleware::class,
            'is_olympiad_manager' => OlympiadManagerMiddleware::class,
            'is_education_manager' => EducationManagerMiddleware::class,
        ]);

        $middleware->web([
            HandleInertiaRequests::class,
            ShareRecaptchaKeyMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
