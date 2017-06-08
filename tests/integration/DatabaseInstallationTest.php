<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class DatabaseInstallationTest extends TestCase {

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
