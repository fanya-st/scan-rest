<?php


namespace App\Auth\Command;


use App\Models\User;
use App\Object\Email;

class SignInUser
{
    public static function signByEmail(string $email, string $password): User
    {
        $user=new User();
        $email=new Email($email);
        $user->email=$email->getEmail();
        $user->password_hash=password_hash($password,PASSWORD_ARGON2I);
        $user->status=0;
        $user->save();
        return $user;
    }
}