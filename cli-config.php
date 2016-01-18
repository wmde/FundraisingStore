<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\Factory;

// Load config for both dependency and standalone use case
if ( file_exists( __DIR__ . '/../../local-db-config.php' ) ) {
	require_once( __DIR__ . '/../../local-db-config.php' );
} else {
	require_once( __DIR__ . '/local-db-config.php' );
}

$factory = new Factory( DriverManager::getConnection( [
	'driver' => 'pdo_mysql',
	'host' => DB_HOST,
	'dbname' => DB_NAME,
	'user' => DB_USER,
	'password' => DB_PASS
] ) );

return ConsoleRunner::createHelperSet( $factory->getEntityManager() );
