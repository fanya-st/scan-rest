<?php

use DI\Container;

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
        return \Doctrine\ORM\EntityManager::create(
            $settings['doctrine']['connection'],
            $config
        );
}

];