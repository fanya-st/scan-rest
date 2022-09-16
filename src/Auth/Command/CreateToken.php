<?php


namespace App\Auth\Command;


use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;

class CreateToken
{
    public static function create(int $user_id, ContainerInterface $container): string
    {
        $conf = [
            "iss" => "scan",
            "aud" => "scan",
            "iat" => time(),
            "exp" => time()+ 3600,
            "user_id" => $user_id,
        ];

        return JWT::encode($conf,$container->get('jwt-secret'),'HS256');
    }
}