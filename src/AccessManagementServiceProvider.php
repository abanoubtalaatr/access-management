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
        Route::middleware('api') // Apply global middleware (for API requests)
            ->prefix('api') // Add a prefix to the routes
            ->group(__DIR__ . '/../routes/api.php'); // Load the routes from the package's route file
    }
}
