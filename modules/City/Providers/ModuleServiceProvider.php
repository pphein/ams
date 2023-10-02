<?php

namespace City\Providers;

use City\Models\City;
use City\Services\CityService;
use Illuminate\Support\ServiceProvider;
use City\Repositories\CityRepository;
use City\Contracts\Models\CityInterface;
use City\Contracts\Services\CityServiceInterface;
use City\Contracts\Repositories\CityRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CityInterface::class, City::class);

        $this->app->bind(CityServiceInterface::class, CityService::class);

        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    }

    /**
     * Bootstrap any application services.CityServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
