<?php


namespace App\Helpers;


use Psr\Http\Message\ResponseInterface;

class Http
{
    public static function json(ResponseInterface $response, $data ): ResponseInterface
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type','application/json');
    }
}