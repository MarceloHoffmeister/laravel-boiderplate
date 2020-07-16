<?php


namespace App\Domains\Person\Http\Routes;


use App\Support\Http\RouteFile;

class Routes extends RouteFile
{
    public function routes()
    {
        $this->router->get('/', 'UserController@index')->name('user');
        $this->router->post('/', 'UserController@store')->name('user');
    }
}
