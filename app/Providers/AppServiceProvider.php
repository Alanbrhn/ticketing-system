<?php

namespace App\Providers;

use App\Http\ViewComposers\SidebarComposer;
use App\Repositories\IMenuRepository;
use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\MenuService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(\App\Services\MenuService::class);
        $this->app->bind(IMenuRepository::class, MenuRepositoryEloquent::class);
    }
}
