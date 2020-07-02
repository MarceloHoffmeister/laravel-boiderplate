<?php


namespace App\Domains\Auth\Tests\Feature;


use App\Support\Tests\TestCase;

class AuthIntegrationTest extends TestCase
{
    public function testStatusRouteAuthRegister()
    {
        $user = [
            'name' => 'Marcelo Hoffmeister',
            'email' => 'marcelohoffmeister@mail.com',
            'password' => 'valid-password'
        ];

        $response = $this->post('auth/register', $user);
        $response->assertStatus(200);
    }

    public function testResponseRouteAuthRegister()
    {
        $user = [
            'name' => 'Marcelo Hoffmeister',
            'email' => 'marcelohoffmeister@mail.com',
            'password' => 'valid-password'
        ];

        $response = $this->post('auth/register', $user);
        $response = collect($response->getOriginalContent())->toArray();
        $this->assertEquals('success', $response['message']);
        $this->assertNotEmpty($response['user']);
    }

    public function testResponseRouteAuthLogin()
    {
        $login = [
            'email' => 'marcelohoffeister@mail.com',
            'password' => 'valid-password'
        ];

        $response = $this->post('auth/login', $login);
        $response = collect($response->getOriginalContent())->toArray();
        $this->assertEquals('login success', $response['message']);
        $this->assertNotEmpty($response['user']);
    }
}
