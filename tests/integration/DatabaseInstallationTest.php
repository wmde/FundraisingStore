<?php

namespace WMDE\Fundraising\Store\Tests;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class DatabaseInstallationTest extends \PHPUnit_Framework_TestCase {

	public function testGetTablesAreThere() {
		$environment = TestEnvironment::newDefault();

		$tableNames = $environment->getFactory()->getConnection()->getSchemaManager()->createSchema()->getTableNames();

		$dbName = $environment->getDatabaseName();

		$this->assertSame(
			[
				$dbName . '.action_log',
				$dbName . '.address',
				$dbName . '.backend_banner',
				$dbName . '.backend_impressions',
				$dbName . '.request',
				$dbName . '.spenden',
				$dbName . '.subscription',
				$dbName . '.users',
			],
			$tableNames
		);
	}

}
