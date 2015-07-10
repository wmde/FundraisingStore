<?php

namespace WMDE\Fundraising\Store;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

/**
 * @since 0.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class Factory {

	public function __construct( Connection $connection ) {
		$this->connection = $connection;
	}

	public function newInstaller() {
		return new Installer( $this->getEntityManager() );
	}

	/**
	 * @return EntityManager
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \Doctrine\ORM\ORMException
	 */
	private function getEntityManager() {
		$paths = [ __DIR__ . '/../Entities/' ];
		$config = Setup::createConfiguration();

		$driver = new AnnotationDriver( new AnnotationReader(), $paths );
		AnnotationRegistry::registerLoader( 'class_exists' );
		$config->setMetadataDriverImpl($driver);

		$entityManager = EntityManager::create( $this->connection, $config );

		$platform = $entityManager->getConnection()->getDatabasePlatform();
		$platform->registerDoctrineTypeMapping( 'enum', 'string' );

		return $entityManager;
	}

	/**
	 * @return Connection
	 */
	public function getConnection() {
		return $this->connection;
	}

}
