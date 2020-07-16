<?php


namespace App\Domains\Person\Http\Controllers;


use App\Domains\Person\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $models = $this->service->index($request->all());

        return response()->json([
            'message' => 'success',
            'users' => $models,
            'code' => 200
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        $model = $this->service->store($request->all());

        return response()->json([
           'message' => 'success',
           'user' => $model,
           'code' => 200
        ]);
    }
}
