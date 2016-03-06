<?php

namespace WMDE\Fundraising\Store;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * @since 0.1
 *
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
		$this->getSchemaTool()->createSchema( $this->getClassMetaData() );
	}

	public function uninstall() {
		$this->getSchemaTool()->dropSchema( $this->getClassMetaData() );
	}

	private function getSchemaTool() {
		return new SchemaTool( $this->entityManager );
	}

	private function getClassMetaData() {
		return $this->entityManager->getMetadataFactory()->getAllMetadata();
	}

}
