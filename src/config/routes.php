<?php

use Slim\App;


return static function(App $app):void {
    $app->get('/hello/{name}', \App\Action\RestAction::class);
};
