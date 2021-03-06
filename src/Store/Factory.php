<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Gedmo\Timestampable\TimestampableListener;

/**
 * @since 0.1
 *
 * @license GNU GPL v2+
 */
class Factory {

	private $entityManager;
	private $proxyDir;
	private $doctrineEntityPaths;
	private $additionalMetadataDrivers;

	private const DEFAULT_DOCTRINE_ENTITY_PATHS = [__DIR__ . '/../Entities/'];

	/**
	 * Factory constructor.
	 * @param Connection $connection
	 * @param string $proxyDir
	 * @param string[] $doctrineEntityPaths Paths to additional annotated entities that are not part of the store
	 * @param MappingDriver[] $additionalMetadataDrivers namespace => driver
	 */
	public function __construct( Connection $connection, $proxyDir = '/tmp', array $doctrineEntityPaths = [],
			$additionalMetadataDrivers = [] ) {
		$this->connection = $connection;
		$this->proxyDir = $proxyDir;
		$this->doctrineEntityPaths = $doctrineEntityPaths;
		$this->additionalMetadataDrivers = $additionalMetadataDrivers;
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
		$config = Setup::createConfiguration();
		$paths = array_merge( self::DEFAULT_DOCTRINE_ENTITY_PATHS, $this->doctrineEntityPaths );

		$annotationReader = new AnnotationReader();
		$annotationDriver = new AnnotationDriver( $annotationReader, $paths );
		AnnotationRegistry::registerLoader( 'class_exists' );
		$driver = new MappingDriverChain();
		$driver->addDriver( $annotationDriver, 'WMDE\Fundraising\Entities' );
		foreach ( $this->additionalMetadataDrivers as $namespace => $additionalMetadataDriver ) {
			$driver->addDriver( $additionalMetadataDriver, $namespace );
		}
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
