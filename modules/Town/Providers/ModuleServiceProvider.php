<?php

namespace Town\Providers;

use Town\Models\Town;
use Town\Services\TownService;
use Illuminate\Support\ServiceProvider;
use Town\Repositories\TownRepository;
use Town\Contracts\Models\TownInterface;
use Town\Contracts\Services\TownServiceInterface;
use Town\Contracts\Repositories\TownRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TownInterface::class, Town::class);

        $this->app->bind(TownServiceInterface::class, TownService::class);

        $this->app->bind(TownRepositoryInterface::class, TownRepository::class);
    }

    /**
     * Bootstrap any application services.TownServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
