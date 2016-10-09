<?php
/**
 * This script is for using the vendor/bin/doctrine command while developing
 * the FundraisingStore library.
 *
 * If you include FundraisingStore in your application you'll have to create a similar file
 * in your application root. That file should also initialize the database,
 * using a configuration method that fits your application.
 */
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WMDE\Fundraising\Store\Factory;

require_once( __DIR__ . '/local-db-config.php' );

$factory = new Factory( DriverManager::getConnection( [
	'driver' => 'pdo_mysql',
	'host' => DB_HOST,
	'dbname' => DB_NAME,
	'user' => DB_USER,
	'password' => DB_PASS
] ) );

return ConsoleRunner::createHelperSet( $factory->getEntityManager() );
