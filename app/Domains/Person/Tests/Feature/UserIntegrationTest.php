<?php


namespace App\Domains\Person\Tests\Feature;


use App\Domains\Person\Database\Models\User;
use App\Domains\Person\Tests\DatabaseMigrationsPerson;
use App\Support\Tests\TestCase;

class UserIntegrationTest extends TestCase
{
    use DatabaseMigrationsPerson;

    public function testStatusRouteUserIndex()
    {
        $response = $this->get('user');
        $response->assertStatus(200);
    }

    public function testResponseRouteUserIndex()
    {
        factory(User::class, 1)->create();
        $response = $this->get('user');
        $response = collect($response->getOriginalContent())->toArray();
        $this->assertEquals('success', $response['message']);
        $this->assertNotEmpty($response['users']);
    }
}
