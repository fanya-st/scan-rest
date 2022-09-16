<?php


namespace App\Auth\Command;


use App\Models\UserRefreshToken;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;

class CreateRefreshToken
{
    public static function create(int $user_id, ContainerInterface $container): string
    {
        $conf = [
            "iss" => "scan",
            "aud" => "scan",
            "iat" => time(),
            "exp" => time()+86400,
            "user_uuid" => $user_id,
        ];
        UserRefreshToken::query()->where('user_id','=',$user_id)->delete();
        $user_token=new UserRefreshToken();
        $user_token->user_id=$user_id;
        $user_token->refresh=JWT::encode($conf,$container->get('jwt-secret'),'HS256');
        $user_token->save();

        return $user_token->refresh;
    }
}