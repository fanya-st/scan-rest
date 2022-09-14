<?php


namespace App\Auth\Command;


use App\Models\User;

class SignInUser
{
    public static function signByEmail(string $email, string $password): User
    {
        $user=new User();
        $user->email=$email;
        $user->password_hash=password_hash($password,PASSWORD_ARGON2I);
        $user->save();
        return $user;
    }
}