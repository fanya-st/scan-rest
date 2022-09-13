<?php


namespace App\Auth\Command\JoinByEmail;


use App\Object\Email;
use App\Models\User;

class JoinByEmailAction
{
    public static function joinByEmail(JoinByEmail $data): void
    {
        $user=new User(
            new Email($data->email),
            password_hash($data->password,PASSWORD_ARGON2I),
        );
    }
}