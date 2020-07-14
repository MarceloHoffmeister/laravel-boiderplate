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

    public function testResponseRouteAuthLogin()
    {
        $user = factory(User::class)->make()->toArray();
        $this->post('auth/register', $user);

        $login = [
            'email' => $user['email'],
            'password' => $user['password']
        ];

        $response = $this->post('auth/login', $login);
        $user = collect($response->getOriginalContent())->toArray();

        $this->assertArrayHasKey('access_token', $user);
        $this->assertNotEmpty($user);
    }

    public function testResponseRouteAuthLogout()
    {
        $user = factory(User::class)->make()->toArray();
        $this->post('auth/register', $user);

        $login = [
            'email' => $user['email'],
            'password' => $user['password'],
        ];

        $response = $this->post('auth/login', $login);
        $user = collect($response->getOriginalContent())->toArray();

        $response = $this->post('auth/logout', ['Authorization' => 'Bearer '.$user['access_token']]);

        $this->assertArrayHasKey('access_token', $user);
        $this->assertNotEmpty($user);
        $response->assertStatus(302);

    }

//        Artisan::call('migrate:refresh --path=database/migrations --env=testing');
//        Artisan::call('passport:install --env=testing');
//
//        $secret = DB::connection('testing')
//            ->table('oauth_clients')
//            ->select('id', 'secret')
//            ->orderBy('id', 'desc')
//            ->get();
//        $secret = $secret->toArray()[0];
//
//        Artisan::call('config:clear');
//
//        $env = base_path('.env.testing');
//
//        $file = file_get_contents($env);
//        if (env('CLIENT_ID') !== null) {
//            file_put_contents($env, str_replace(
//                'CLIENT_ID='.env('CLIENT_ID'), 'CLIENT_ID='.$secret->id, $file
//            ));
//        } else {
//            file_put_contents($env, 'CLIENT_ID='.$secret->id.PHP_EOL, FILE_APPEND);
//        }
//
//        $file = file_get_contents($env);
//
//        if (env('CLIENT_SECRET') !== null) {
//            file_put_contents($env, str_replace(
//                'CLIENT_SECRET='.env('CLIENT_SECRET'), 'CLIENT_SECRET='.$secret->secret, $file
//            ));
//        } else {
//            file_put_contents($env, 'CLIENT_SECRET='.$secret->secret.PHP_EOL, FILE_APPEND);
//        }
}
