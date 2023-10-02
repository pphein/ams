<?php

namespace District\Providers;

use District\Models\District;
use District\Services\DistrictService;
use Illuminate\Support\ServiceProvider;
use District\Repositories\DistrictRepository;
use District\Contracts\Models\DistrictInterface;
use District\Contracts\Services\DistrictServiceInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DistrictInterface::class, District::class);

        $this->app->bind(DistrictServiceInterface::class, DistrictService::class);

        $this->app->bind(DistrictRepositoryInterface::class, DistrictRepository::class);
    }

    /**
     * Bootstrap any application services.DistrictServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
