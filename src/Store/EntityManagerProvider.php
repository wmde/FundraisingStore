<?php

namespace WMDE\Fundraising\Store;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

/**
 * @licence GNU GPL v2+
 * @author Leszek Manicki <leszek.manicki@wikimedia.de>
 */
class EntityManagerProvider {

	private $connection;

	public function __construct( Connection $connection ) {
		$this->connection = $connection;
	}

	/**
	 * @return EntityManager
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function getEntityManager() {
		$paths = [ __DIR__ . '/../Entities/' ];
		$config = Setup::createConfiguration();

		$driver = new AnnotationDriver( new AnnotationReader(), $paths );
		AnnotationRegistry::registerLoader( 'class_exists' );
		$config->setMetadataDriverImpl( $driver );

		$entityManager = EntityManager::create( $this->connection, $config );

		$platform = $entityManager->getConnection()->getDatabasePlatform();
		$platform->registerDoctrineTypeMapping( 'enum', 'string' );

		return $entityManager;
	}
}
