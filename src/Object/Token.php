<?php


namespace App\Object;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;


final class Token
{
    private mixed $token;


    public function __construct(int $id,\DateTimeImmutable $expiration)
    {
        $conf = [
            "iss" => "scan",
            "aud" => "scan",
            "iat" => new \DateTimeImmutable(),
            "exp" => $expiration,
            "user_uuid" => $id,
        ];

        $this->token = JWT::encode($conf,ContainerInterface::class->get('secret-jwt'),'HS256');
    }
}