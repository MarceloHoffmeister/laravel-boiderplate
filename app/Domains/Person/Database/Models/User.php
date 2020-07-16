<?php


namespace App\Domains\Person\Database\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'public.users';

//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    protected $fillable = ['name', 'email', 'password'];
}
