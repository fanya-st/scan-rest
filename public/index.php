<?php
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';


//config container
$builder= new ContainerBuilder();


$builder->addDefinitions(require __DIR__.'/../src/config/dependencies.php');
//$builder->addDefinitions(require __DIR__.'/../src/config/doctrine.php');
$container = $builder->build();

// Instantiate App
$app=AppFactory::createFromContainer($container);

(require __DIR__.'/../src/config/middleware.php')($app, $container);
(require __DIR__.'/../src/config/routes.php')($app);
(require __DIR__.'/../src/config/eloquent.php')($app);

$app->run();