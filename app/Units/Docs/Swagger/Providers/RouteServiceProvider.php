<?php


namespace App\Units\Docs\Swagger\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerViews();
        $this->registerRouters();
    }

    protected function registerViews()
    {
        View::addLocation(app()->path().'/Units/Docs/Swagger/Views');
    }

    protected function registerRouters()
    {
        Route::view('/docs/api', 'swagger');
    }
}
