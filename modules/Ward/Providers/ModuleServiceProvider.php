<?php

namespace Ward\Providers;

use Ward\Models\Ward;
use Ward\Services\WardService;
use Illuminate\Support\ServiceProvider;
use Ward\Repositories\WardRepository;
use Ward\Contracts\Models\WardInterface;
use Ward\Contracts\Services\WardServiceInterface;
use Ward\Contracts\Repositories\WardRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WardInterface::class, Ward::class);

        $this->app->bind(WardServiceInterface::class, WardService::class);

        $this->app->bind(WardRepositoryInterface::class, WardRepository::class);
    }

    /**
     * Bootstrap any application services.WardServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
