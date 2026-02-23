<?php

namespace App\Providers;

use App\Repositories\Interfaces\EducationDirectionRepositoryInterface;
use App\Repositories\Interfaces\EducationSchoolRepositoryInterface;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Olympiad\OlympiadRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    private const BINDINGS = [
        OlympiadRepositoryInterface::class => OlympiadRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        EducationDirectionRepositoryInterface::class => EducationDirectionRepository::class,
        EducationSchoolRepositoryInterface::class => EducationSchoolRepository::class
    ];
    public function register(): void
    {
        foreach (self::BINDINGS as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
