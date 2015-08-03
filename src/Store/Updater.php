<?php

namespace WMDE\Fundraising\Store;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * @since 0.2
 *
 * @licence GNU GPL v2+
 * @author Christoph Fischer < christoph.fischer@wikimedia.de >
 */
class Updater {

	private $entityManager;

	public function __construct( EntityManager $entityManager ) {
		$this->entityManager = $entityManager;
	}

	public function update() {
		$schemaTool = new SchemaTool( $this->entityManager );
		$classesMetaData = $this->entityManager->getMetadataFactory()->getAllMetadata();

		$schemaTool->updateSchema( $classesMetaData );
	}

}
