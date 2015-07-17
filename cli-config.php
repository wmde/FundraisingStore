<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\Factory;

require_once( '../../local-db-config.php' );

$factory = new Factory( DriverManager::getConnection( [
	'driver' => 'pdo_mysql',
	'host' => DB_HOST,
	'dbname' => DB_NAME,
	'user' => DB_USER,
	'password' => DB_PASS
] ) );

return ConsoleRunner::createHelperSet( $factory->getEntityManager() );
