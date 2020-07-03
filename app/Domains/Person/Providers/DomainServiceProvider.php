<?php


namespace App\Domains\Person\Providers;


use App\Domains\Person\Database\Factories\UserFactory;
use App\Support\Providers\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerFactories();
    }

    protected function registerRoutes(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    private function registerFactories(): void
    {
        (new UserFactory())->define();
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom('app/Domains/Person/Database/Migrations');
    }
}
