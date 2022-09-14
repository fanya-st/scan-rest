<?php


namespace App\Auth\Command;


use App\Models\User;

class AuthUser
{
    public static function auth(string $email,string $password): object
    {

        $user=User::query()->where('email','=',$email)->first();
        if($user->verifyPassword($password))
            return $user;
    }
}