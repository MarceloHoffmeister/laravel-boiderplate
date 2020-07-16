<?php


namespace App\Domains\Auth\Providers;


use App\Support\Providers\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRoutes();
//        $this->registerFactories();
    }

    protected function registerRoutes(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    private function registerFactories(): void
    {
//        (new IncidentsFactory())->define();
    }
}
