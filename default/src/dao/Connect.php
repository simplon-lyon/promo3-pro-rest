<?php

namespace simplon\dao;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Connect {
    private static $instance;
    private $em;

    private function __construct() {

        $paths = array(__DIR__."/../entities");
        $isDevMode = true;

        // the connection configuration
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'db',
            'host' => 'mysql'
        );

        $config = Setup::createConfiguration($isDevMode);
        $driver = new AnnotationDriver(new AnnotationReader(), $paths);
        
        // registering noop annotation autoloader - allow all annotations by default
        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);
        
        $this->em = EntityManager::create($dbParams, $config);

    }

    public static function getInstance():EntityManager {
        if(self::$instance == null) {
            self::$instance = new Connect();
        }
        return self::$instance->em;
    }


}