<?php


namespace App\Domains\Person\Tests;


use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

trait DatabaseMigrationsPerson
{
    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->artisan('migrate:fresh --path=app/Domains/Person/Database/Migrations');

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback --path=app/Domains/Person/Database/Migrations');

            RefreshDatabaseState::$migrated = false;
        });
    }
}
