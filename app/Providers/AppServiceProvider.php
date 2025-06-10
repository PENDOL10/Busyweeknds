<?php

namespace App\Providers;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AdminController::class, function ($app) {
            return new AdminController();
        });

        $this->app->bind(AdminDashboardController::class, function ($app) {
            return new AdminDashboardController();
        });
    }

    public function boot()
    {
        //
    }
}