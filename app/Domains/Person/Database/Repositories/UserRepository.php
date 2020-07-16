<?php


namespace App\Domains\Person\Database\Repositories;


use App\Domains\Person\Database\Models\User;
use App\Support\Database\Repository;

class UserRepository extends Repository
{
    protected $modelClass = User::class;
}
