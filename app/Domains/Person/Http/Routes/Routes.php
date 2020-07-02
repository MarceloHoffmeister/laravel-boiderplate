<?php


namespace App\Domains\Person\Http\Routes;


use App\Support\Http\RouteFile;

class Routes extends RouteFile
{
    public function routes()
    {
        $this->router->get('/', 'UserController@index');
        $this->router->post('/', 'UserController@store');
    }
}
