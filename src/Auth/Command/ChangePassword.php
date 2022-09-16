<?php


namespace App\Auth\Command;


use App\Models\User;

class ChangePassword
{
    public static function change(int $user_id, string $new_password): bool|\RuntimeException
    {
        $user=User::query()->findOrFail($user_id);
            $user->password_hash=password_hash($new_password,PASSWORD_ARGON2I);
            if($user->save())
                return true;
            else
                return new \RuntimeException('Error');
    }
}