<?php


namespace App\Units\Docs\Swagger\Providers;


use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
