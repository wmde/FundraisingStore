<?php

namespace WMDE\Fundraising\Store;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Jonas Kress
 */
class Installer {

	private $entityManager;

	public function __construct( EntityManager $entityManager ) {
		$this->entityManager = $entityManager;
	}

	public function install() {
		$schemaTool = new SchemaTool( $this->entityManager );
		$classesMetaData = $this->entityManager->getMetadataFactory()->getAllMetadata();

		$schemaTool->createSchema( $classesMetaData );
	}

}
