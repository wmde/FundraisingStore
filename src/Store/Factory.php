<?php

namespace WMDE\Fundraising\Store;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Gedmo\Timestampable\TimestampableListener;

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

	/**
	 * @since 0.1
	 * @return Installer
	 */
	public function newInstaller() {
		return new Installer( $this->getEntityManager() );
	}

	/**
	 * @since 0.1
	 * @return EntityManager
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function getEntityManager() {
		$paths = [ __DIR__ . '/../Entities/' ];
		$config = Setup::createConfiguration();

		$annotationReader = new AnnotationReader();
		$driver = new AnnotationDriver( $annotationReader, $paths );
		AnnotationRegistry::registerLoader( 'class_exists' );
		$config->setMetadataDriverImpl( $driver );

		$eventManager = $this->connection->getEventManager();
		$timestampableListener = new TimestampableListener;
		$timestampableListener->setAnnotationReader( $annotationReader );
		$eventManager->addEventSubscriber( $timestampableListener );

		$entityManager = EntityManager::create( $this->connection, $config, $eventManager );

		$platform = $entityManager->getConnection()->getDatabasePlatform();
		$platform->registerDoctrineTypeMapping( 'enum', 'string' );

		return $entityManager;
	}

	/**
	 * @since 0.1
	 * @return Connection
	 */
	public function getConnection() {
		return $this->connection;
	}

}
