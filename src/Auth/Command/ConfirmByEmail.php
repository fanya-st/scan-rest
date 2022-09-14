<?php


namespace App\Auth\Command;


use App\Models\User;
use App\Models\UserConfirmToken;

class ConfirmByEmail
{
    public static function confirm(string $token): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {

        $userConfirmToken=UserConfirmToken::query()->where('token','=',$token)->firstOrFail();
        if(!empty($userConfirmToken)){
            $user=User::query()->where('id','=',$userConfirmToken->user_id)->firstOrFail();
            $user->status=1;
            $user->save();
            return $user;
        }
    }
}