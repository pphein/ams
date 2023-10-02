<?php

namespace Township\Providers;

use Township\Models\Township;
use Township\Services\TownshipService;
use Illuminate\Support\ServiceProvider;
use Township\Repositories\TownshipRepository;
use Township\Contracts\Models\TownshipInterface;
use Township\Contracts\Services\TownshipServiceInterface;
use Township\Contracts\Repositories\TownshipRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TownshipInterface::class, Township::class);

        $this->app->bind(TownshipServiceInterface::class, TownshipService::class);

        $this->app->bind(TownshipRepositoryInterface::class, TownshipRepository::class);
    }

    /**
     * Bootstrap any application services.TownshipServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
