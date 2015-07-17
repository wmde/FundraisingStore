<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\Factory;

$config = parse_ini_file( 'config.ini', true );

$factory = new Factory( DriverManager::getConnection( $config['database'] ) );

return ConsoleRunner::createHelperSet( $factory->getEntityManager() );
