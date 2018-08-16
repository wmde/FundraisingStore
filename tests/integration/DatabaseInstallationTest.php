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

	private $databaseName;
	private $tableNames;

	public function setUp() {
		$environment = TestEnvironment::newDefault();
		$this->databaseName = $environment->getDatabaseName();
		$this->tableNames = $environment->getFactory()->getConnection()->getSchemaManager()->createSchema()->getTableNames();
	}

	/**
	 * @dataProvider expectedTableNameProvider
	 */
	public function testTablesAreCreated( string $tableName ) {
		$this->assertContains(
			$this->databaseName . '.' . $tableName,
			$this->tableNames
		);
	}

	public function expectedTableNameProvider() {
		yield [ 'address' ];
		yield [ 'request' ];
		yield [ 'spenden' ];
		yield [ 'subscription' ];
		yield [ 'donation_payment' ];
		yield [ 'donation_payment_sofort' ];
	}

}
