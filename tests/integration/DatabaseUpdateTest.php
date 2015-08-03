<?php

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\DBAL\Schema\Schema;

/**
 * @licence GNU GPL v2+
 * @author Christoph Fischer < christoph.fischer@wikimedia.de >
 */
class DatabaseUpdateTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \WMDE\Fundraising\Store\Factory
	 */
	private $factory;

	public function setUp() {
		$this->factory = TestEnvironment::newDefault()->getFactory();
	}

	public function testMissingTableIsThereAfterUpdate() {
		$schemaTo = $this->factory->getConnection()->getSchemaManager()->createSchema();
		$schemaTo->dropTable( 'action_log' );

		$this->updateDatabaseBySchema( $schemaTo );

		$this->assertNotContains(
			'public.action_log',
			$this->factory->getConnection()->getSchemaManager()->createSchema()->getTableNames()
		);

		$this->factory->newUpdater()->update();

		$this->assertContains(
			'public.action_log',
			$this->factory->getConnection()->getSchemaManager()->createSchema()->getTableNames()
		);
	}

	public function testMissingColumnIsThereAfterUpdate() {
		$schemaTo = $this->factory->getConnection()->getSchemaManager()->createSchema();
		$schemaTo->getTable( 'action_log' )->dropColumn( 'al_username' );

		$this->updateDatabaseBySchema( $schemaTo );

		$this->assertArrayNotHasKey(
			'al_username',
			$this->factory->getConnection()->getSchemaManager()->createSchema()->getTable( 'action_log' )->getColumns()
		);

		$this->factory->newUpdater()->update();

		$this->assertArrayHasKey(
			'al_username',
			$this->factory->getConnection()->getSchemaManager()->createSchema()->getTable( 'action_log' )->getColumns()
		);
	}

	private function updateDatabaseBySchema( Schema $schemaTo ) {
		$schemaFrom = $this->factory->getConnection()->getSchemaManager()->createSchema();
		$updateSql = $schemaFrom->getMigrateToSql( $schemaTo, $this->factory->getConnection()->getDatabasePlatform() );

		foreach ($updateSql as $sql) {
			$this->factory->getConnection()->executeQuery($sql);
		}
	}

}
