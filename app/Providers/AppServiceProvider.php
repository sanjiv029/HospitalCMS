<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Register the namespace if you're using one
        $this->loadViewsFrom(resource_path('views/emails'), 'mail');

        View::composer(['web-components.nav-bar'], function ($view) {
            $menus = Menu::with('children')->whereNull('parent_id')->get(); // Eager-load children
            $view->with('menus', $menus);
        });
    }

}
