<?php

use App\Controller\RestController;
use Slim\App;


return static function(App $app):void {
    $app->get('/test', RestController::class . ':test');
    $app->post('/sign-email', RestController::class . ':signByEmail');
    $app->get('/sign-confirm-email/{token}', RestController::class . ':confirmByEmail');
    $app->post('/login', RestController::class . ':login');
    $app->get('/change-password', RestController::class . ':changePassword');

};
