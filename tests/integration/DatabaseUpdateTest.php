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

	/**
	 * @var \Doctrine\DBAL\Schema\AbstractSchemaManager
	 */
	private $schemaManager;

	public function setUp() {
		$this->factory = TestEnvironment::newDefault()->getFactory();
		$this->schemaManager = $this->factory->getConnection()->getSchemaManager();
	}

	public function testMissingTableIsThereAfterUpdate() {
		$schemaTo = $this->schemaManager->createSchema();
		$schemaTo->dropTable( 'action_log' );

		$this->updateDatabaseBySchema( $schemaTo );

		$this->assertNotContains(
			'public.action_log',
			$this->schemaManager->createSchema()->getTableNames()
		);

		$this->factory->newUpdater()->update();

		$this->assertContains(
			'public.action_log',
			$this->schemaManager->createSchema()->getTableNames()
		);
	}

	public function testMissingColumnIsThereAfterUpdate() {
		$schemaTo = $this->schemaManager->createSchema();
		$schemaTo->getTable( 'action_log' )->dropColumn( 'al_username' );

		$this->updateDatabaseBySchema( $schemaTo );

		$this->assertArrayNotHasKey(
			'al_username',
			$this->schemaManager->createSchema()->getTable( 'action_log' )->getColumns()
		);

		$this->factory->newUpdater()->update();

		$this->assertArrayHasKey(
			'al_username',
			$this->schemaManager->createSchema()->getTable( 'action_log' )->getColumns()
		);
	}

	private function updateDatabaseBySchema( Schema $schemaTo ) {
		$schemaFrom = $this->schemaManager->createSchema();
		$updateSql = $schemaFrom->getMigrateToSql( $schemaTo, $this->factory->getConnection()->getDatabasePlatform() );

		foreach ($updateSql as $sql) {
			$this->factory->getConnection()->executeQuery($sql);
		}
	}

}
