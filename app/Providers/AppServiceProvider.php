<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\SidebarComposer;

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
        View::composer('*', SidebarComposer::class);
    }
}
