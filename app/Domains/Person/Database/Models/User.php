<?php


namespace App\Domains\Person\Database\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'public.users';

    protected $fillable = ['name', 'email', 'password'];
}
