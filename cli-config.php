<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\Factory;

require_once __DIR__ . '/vendor/autoload.php';

$config = parse_ini_file( __DIR__ . '/config.ini', true );

$factory = new Factory( DriverManager::getConnection( $config['database'] ) );

return ConsoleRunner::createHelperSet( $factory->getEntityManager() );
