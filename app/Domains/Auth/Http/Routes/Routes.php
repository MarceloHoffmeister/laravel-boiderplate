<?php


namespace App\Domains\Auth\Http\Routes;


use App\Support\Http\RouteFile;

class Routes extends RouteFile
{
    protected function routes()
    {
        $this->router->post('/register', 'AuthController@register')->name('auth.register');
        $this->router->post('/login', 'AuthController@login')->name('auth.login');
        $this->router->post('/logout', 'AuthController@logout')->name('auth.logout')->middleware('auth:api');
    }
}
