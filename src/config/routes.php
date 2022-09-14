<?php

use App\Controller\RestController;
use Slim\App;


return static function(App $app):void {
    $app->get('/test', RestController::class . ':test');
    $app->post('/sign-email', RestController::class . ':signByEmail');
    $app->post('/login', RestController::class . ':login');
//    $app->get('/contact', RestController::class . ':contact');
};
