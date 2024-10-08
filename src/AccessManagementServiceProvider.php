<?php

namespace BirdSol\AccessManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use BirdSol\AccessManagement\Console\Commands\InstallApi;

class AccessManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/routes/api.php');
    }
}
