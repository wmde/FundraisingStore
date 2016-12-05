<?php

declare( strict_types = 1 );

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
 * @author Kai Nissen < kai.nissen@wikimedia.de >
 */
class Factory {

	private $entityManager;
	private $proxyDir;

	public function __construct( Connection $connection, $proxyDir = '/tmp' ) {
		$this->connection = $connection;
		$this->proxyDir = $proxyDir;
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
		if ( !$this->entityManager ) {
			$this->entityManager = $this->setupEntityManager();
		}

		return $this->entityManager;
	}

	private function setupEntityManager() {
		$paths = [ __DIR__ . '/../Entities/' ];
		$config = Setup::createConfiguration();

		$annotationReader = new AnnotationReader();
		$driver = new AnnotationDriver( $annotationReader, $paths );
		AnnotationRegistry::registerLoader( 'class_exists' );
		$config->setMetadataDriverImpl( $driver );
		$config->setProxyDir( $this->proxyDir );

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
