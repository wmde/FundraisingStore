<?php

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\ORM\Tools\SchemaTool;

/**
 * @licence GNU GPL v2+
 * @author Christoph Fischer < christoph.fischer@wikimedia.de >
 */
class DatabaseUpdateTest extends \PHPUnit_Framework_TestCase {

	public function testMissingTableIsThereAfterUpdate() {
		$factory = TestEnvironment::newDefault()->getFactory();
		$entityManager = $factory->getEntityManager();

		$schemaTool = new SchemaTool( $entityManager );
		$actionLogMetaData = $entityManager->getMetadataFactory()->getMetadataFor( 'WMDE\Fundraising\Entities\ActionLog' );
		$schemaTool->dropSchema( array( $actionLogMetaData ) );

		$this->assertNotContains(
			'public.action_log',
			$factory->getConnection()->getSchemaManager()->createSchema()->getTableNames()
		);

		$factory->newUpdater()->update();

		$this->assertContains(
			'public.action_log',
			$factory->getConnection()->getSchemaManager()->createSchema()->getTableNames()
		);
	}

}
