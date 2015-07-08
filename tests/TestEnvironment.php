<?php

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
		$this->factory = new Factory( DriverManager::getConnection( [
			'driver' => 'pdo_sqlite',
			'memory' => true,
		] ) );

		$this->factory->newInstaller()->install();
	}

	public function getFactory() {
		return $this->factory;
	}

}
