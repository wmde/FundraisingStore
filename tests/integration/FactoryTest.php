<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\DBAL\DriverManager;
use WMDE\Fundraising\Store\Factory;

/**
 * @licence GNU GPL v2+
 * @author Kai Nissen < kai.nissen@wikimedia.de >
 */
class FactoryTest extends \PHPUnit_Framework_TestCase {

	const PROXY_PATH = '/path/to/proxy/classes/';

	public function testGivenCustomProxyDir_itIsPassedToProxyGenerator() {
		$factory = new Factory( $this->newConnection(), self::PROXY_PATH );
		$this->assertSame( self::PROXY_PATH, $factory->getEntityManager()->getConfiguration()->getProxyDir() );
	}

	private function newConnection() {
		return DriverManager::getConnection( [ 'driver' => 'pdo_sqlite', 'memory' => true ] );
	}

}
