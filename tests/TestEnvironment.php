<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\DBAL\DriverManager;
use WMDE\Fundraising\Store\Factory;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class TestEnvironment {

	public static function newDefault() {
		return new self();
	}

	private $factory;

	public function __construct() {
		$this->factory = new Factory( DriverManager::getConnection(
			$this->newConnectionDetails()
		) );

		try {
			$this->factory->newInstaller()->uninstall();
		}
		catch ( \Exception $ex ) {
		}

		$this->factory->newInstaller()->install();
	}

	public function getFactory() {
		return $this->factory;
	}

	private function newConnectionDetails() {
		if ( getenv( 'DB' ) === 'mysql' ) {
			return [
				'driver' => 'pdo_mysql',
				'user' => 'root',
				'password' => '',
				'dbname' => 'spenden',
				'host' => 'localhost',
			];
		}

		return [
			'driver' => 'pdo_sqlite',
			'memory' => true,
		];
	}

	public function getDatabaseName() {
		if ( getenv( 'DB' ) === 'mysql' ) {
			return 'spenden';
		}

		return 'public';
	}

}
