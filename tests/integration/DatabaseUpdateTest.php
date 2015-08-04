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

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function setUp() {
		$this->factory = TestEnvironment::newDefault()->getFactory();
		$this->schemaManager = $this->factory->getConnection()->getSchemaManager();
		$this->entityManager = $this->factory->getEntityManager();
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

	public function testChangedColumnIsFixedAfterUpdate() {
		$schemaTo = $this->schemaManager->createSchema();
		$schemaTo->getTable( 'action_log' )->changeColumn( 'al_username', array( 'length' => 30 ) );

		$this->updateDatabaseBySchema( $schemaTo );

		$this->assertSame(
			30,
			$this->schemaManager->createSchema()->getTable( 'action_log' )->getColumn( 'al_username' )->getLength()
		);

		$this->factory->newUpdater()->update();

		$this->assertSame(
			45,
			$this->schemaManager->createSchema()->getTable( 'action_log' )->getColumn( 'al_username' )->getLength()
		);
	}

	public function testDataIsStillThereAfterColumnUpdate() {
		$this->factory->getConnection()->insert( 'action_log', array( 'al_username' => 'test' ) );

		$schemaTo = $this->schemaManager->createSchema();
		$schemaTo->getTable( 'action_log' )->dropColumn( 'al_type' );
		$this->updateDatabaseBySchema( $schemaTo );

		$this->factory->newUpdater()->update();

		$entity = $this->entityManager->getRepository( 'WMDE\Fundraising\Entities\ActionLog' )->findOneBy( array() );

		$this->assertSame(
			'test',
			$entity->getAlUsername()
		);
	}

	private function updateDatabaseBySchema( Schema $schemaTo ) {
		$schemaFrom = $this->schemaManager->createSchema();
		$updateSql = $schemaFrom->getMigrateToSql( $schemaTo, $this->factory->getConnection()->getDatabasePlatform() );

		foreach ( $updateSql as $sql ) {
			$this->factory->getConnection()->executeQuery( $sql );
		}
	}
}
