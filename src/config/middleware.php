<?php

use Slim\App;

return static function(App $app, \Psr\Container\ContainerInterface $container):void {
    $app->addErrorMiddleware(true, true, true);
    $app->add(new Tuupola\Middleware\JwtAuthentication([
        'algorithm' => 'HS256',
        "path" => ["/change-password"],
        /*игнорирование для тестового сервера*/
//        "ignore" => ["/change-password"],
        "secure"=>false,
        "relaxed"=>["scan-rest"],
        "secret" => $container->get('jwt-secret')
    ]));
//    $app->addRoutingMiddleware();
//    $app->addBodyParsingMiddleware();
};
