<?php

namespace State\Providers;

use State\Models\State;
use State\Services\StateService;
use Illuminate\Support\ServiceProvider;
use State\Repositories\StateRepository;
use State\Contracts\Models\StateInterface;
use State\Contracts\Services\StateServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StateInterface::class, State::class);

        $this->app->bind(StateServiceInterface::class, StateService::class);

        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
    }

    /**
     * Bootstrap any application services.StateServiceInterface
     *
     * @return void
     */
    public function boot()
    {
        $routePath = dirname(__DIR__) . '/routes/web.php';
        $this->loadRoutesFrom($routePath);
    }
}
