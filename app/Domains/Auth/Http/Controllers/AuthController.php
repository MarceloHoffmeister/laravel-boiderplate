<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Person\Database\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string'
            ]);

            $http = new Client;

            $response = $http->post(env('LOGIN_ENDPOINT'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                    'username' => $request->email,
                    'password' => $request->password
                ],
            ]);

            return response()->json(
                json_decode($response->getBody())
            );
        } catch (HttpException $exception) {
            if ($exception->getCode() === 400) {
                return response()->json('Invalid request. Please enter a username or password', $exception->getCode());
            } else if ($exception->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $exception->getCode());
            }

            return response()->json('Something went wrong on the server.', $exception->getCode());
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return response()->json('Logged out successfully', 200);
        } catch (HttpException $exception) {
            return response()->json('unsuccessful exit', 500);
        }

    }
}
