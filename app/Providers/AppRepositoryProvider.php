<?php

namespace App\Providers;

use App\Repositories\OlympiadRepository;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    private const BINDINGS = [
        OlympiadRepositoryInterface::class => OlympiadRepository::class,
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
