<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\EntityManagerProvider;

require_once __DIR__ . '/vendor/autoload.php';

$config = parse_ini_file( __DIR__ . '/config.ini', true );

$provider = new EntityManagerProvider( DriverManager::getConnection( $config['database'] ) );
$entityManager = $provider->getEntityManager();

$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping( 'enum', 'string' );

return ConsoleRunner::createHelperSet( $entityManager );
