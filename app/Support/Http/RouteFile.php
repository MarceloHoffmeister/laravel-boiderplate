<?php

namespace App\Support\Http;

abstract class RouteFile
{
    protected $options;

    /*
     * @var
     */
    protected $router;

    /*
     * RouteFile constructor
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = $options;

        $this->router = app('router');
    }

    public function register()
    {

        \Route::pattern('id', '[0-9]+');

        $this->router->group($this->options, function () {
            $this->routes();
        });
    }

    abstract protected function routes();

}
