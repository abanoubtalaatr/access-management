<?php

namespace BirdSol\AccessManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AccessManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();

    }

    protected function registerRoutes()
    {
        Route::middleware('api')
            ->prefix('api') 
            ->group(__DIR__ . '/routes/api.php'); 
    }
}
