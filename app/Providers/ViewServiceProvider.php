<?php

namespace App\Providers;

use App\Store;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.menus.admin', function ($view) { 
            return $view->with('stores', Store::perCompany()->get());
        });
    }

}
