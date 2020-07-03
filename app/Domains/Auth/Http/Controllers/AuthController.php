<?php


namespace App\Domains\Auth\Http\Controllers;


use App\Domains\Person\Database\Models\User;
use Illuminate\Http\Request;

class AuthController
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
           'name' => 'required|string|max:55',
           'email' => 'required|email|unique:users',
           'password' => 'required|string'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = new User($validatedData);
        $user->save();

        $accessToken = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'access_token' => $accessToken,
            'code' => 200
        ]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
           'email' => 'required|email',
           'password' => 'required|string'
        ]);

        if (! auth()->attempt($loginData)) {
            return response()->json([
                'message' => 'invalid credentials',
                'code' => 422
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'login success',
            'user' => auth()->user(),
            'access_token' => $accessToken,
            'code' => 200
        ]);
    }
}
