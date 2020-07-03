<?php


namespace App\Domains\Person\Database\Factories;


use App\Domains\Person\Database\Models\User;
use App\Support\Database\ModelFactory;

class UserFactory extends ModelFactory
{
    protected $model = User::class;

    protected function fields(): array
    {
        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];
    }
}
