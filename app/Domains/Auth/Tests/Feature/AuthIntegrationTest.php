<?php


namespace App\Domains\Auth\Tests\Feature;


use App\Domains\Person\Database\Models\User;
use App\Support\Tests\TestCase;

class AuthIntegrationTest extends TestCase
{
    public function testResponseRouteAuthRegister()
    {
        $user = factory(User::class)->make()->toArray();

        $response = $this->post('auth/register', $user);
        $response->assertStatus(201);
        $user = collect($response->getOriginalContent())->toArray();
        $this->assertNotEmpty($user);
    }

//    public function testResponseRouteAuthLogin()
//    {
//        $user = factory(User::class)->make()->toArray();
//        $this->post('auth/register', $user);
//
//        $login = [
//            'email' => $user['email'],
//            'password' => $user['password']
//        ];
//
//        $response = $this->post('auth/login', $login);
//        dd($response);
//        $response->assertStatus(200);
//        $user = collect($response->getOriginalContent())->toArray();
//        $this->assertNotEmpty($user);
//    }
}
