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

		$updater = $factory->newUpdater();
		$updater->update();

		$tableNames = $factory->getConnection()->getSchemaManager()->createSchema()->getTableNames();
		$this->assertSame(
			[
				'public.action_log',
				'public.backend_banner',
				'public.backend_impressions',
				'public.request',
				'public.spenden',
				'public.users'
			],
			$tableNames
		);
	}

}
