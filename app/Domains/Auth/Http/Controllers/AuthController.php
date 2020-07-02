<?php


namespace App\Domains\Auth\Http\Controllers;


use Illuminate\Http\Request;

class AuthController
{
    public function register(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:55',
           'email' => 'required|email',
           'password' => 'required|string'
        ]);

        return response()->json([
            'message' => 'success',
            'user' => $request->all(),
            'code' => 200
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
           'email' => 'required|email',
           'password' => 'required|string'
        ]);

        return response()->json([
            'message' => 'login success',
            'user' => $request->all(),
            'code' => 200
        ]);
    }
}
