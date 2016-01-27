<?php

namespace WMDE\Fundraising\Store\Tests;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class DatabaseInstallationTest extends \PHPUnit_Framework_TestCase {

	public function testGetTablesAreThere() {
		$factory = TestEnvironment::newDefault()->getFactory();

		$tableNames = $factory->getConnection()->getSchemaManager()->createSchema()->getTableNames();

		$this->assertSame(
			[
				'public.action_log',
				'public.address',
				'public.backend_banner',
				'public.backend_impressions',
				'public.request',
				'public.spenden',
				'public.subscription',
				'public.users',
			],
			$tableNames
		);
	}

}
