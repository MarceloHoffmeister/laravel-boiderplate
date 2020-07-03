<?php


namespace App\Domains\Auth\Tests\Feature;


use App\Domains\Person\Database\Models\User;
use App\Support\Tests\TestCase;

class AuthIntegrationTest extends TestCase
{
    public function testStatusRouteAuthRegister()
    {
        $user = factory(User::class)->make()->toArray();

        $response = $this->post('auth/register', $user);

        $response->assertStatus(200);
    }

    public function testResponseRouteAuthRegister()
    {
        $user = factory(User::class)->make()->toArray();

        $response = $this->post('auth/register', $user);
        $response = collect($response->getOriginalContent())->toArray();
        $this->assertEquals('success', $response['message']);
        $this->assertNotEmpty($response['user']);
    }

    public function testResponseRouteAuthLogin()
    {
        $user = factory(User::class)->make()->toArray();
        $this->post('auth/register', $user);

        $login = [
            'email' => $user['email'],
            'password' => $user['password']
        ];

        $response = $this->post('auth/login', $login);
        $response = collect($response->getOriginalContent())->toArray();
        $this->assertEquals('login success', $response['message']);
        $this->assertNotEmpty($response['user']);
    }
}
