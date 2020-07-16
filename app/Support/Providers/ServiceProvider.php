<?php

namespace App\Support\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

abstract class ServiceProvider extends BaseServiceProvider
{
    protected function registerEloquentFactoriesFrom($path)
    {
        try {
            $this->app->make(Factory::class)->load($path);
        } catch (BindingResolutionException $e) {
        }
    }
}
