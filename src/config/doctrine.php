<?php

use DI\Container;
use Doctrine\DBAL\Types\Type;

return [
    \Doctrine\ORM\EntityManagerInterface::class=>function(Container $container): \Doctrine\ORM\EntityManagerInterface{
        $settings=$container->get(require 'dependencies.php');
        $config=\Doctrine\ORM\ORMSetup::createAttributeMetadataConfiguration(
            $settings['doctrine']['metadata_dir'],
            $settings['doctrine']['dev_mode'],
            $settings['doctrine']['proxy_dir'],
            $settings['doctrine']['cache_dir'],
        );
        $config->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());

        foreach($settings['doctrine']['types'] as $name=>$class){
            if(!Type::hasType($name)){
                Type::addType($name,$class);
            }

        }

        return \Doctrine\ORM\EntityManager::create(
            $settings['doctrine']['connection'],
            $config
        );
}

];
