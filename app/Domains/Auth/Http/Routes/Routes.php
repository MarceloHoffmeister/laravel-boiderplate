<?php


namespace App\Domains\Auth\Http\Routes;


use App\Support\Http\RouteFile;

class Routes extends RouteFile
{
    protected function routes()
    {
        $this->router->post('/register', 'AuthController@register');
        $this->router->post('/login', 'AuthController@login');
    }
}
