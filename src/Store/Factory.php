<?php

namespace WMDE\Fundraising\Store;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;

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
	 */
	private function getEntityManager() {
		$provider = new EntityManagerProvider( $this->connection );
		return $provider->getEntityManager();
	}

	/**
	 * @return Connection
	 */
	public function getConnection() {
		return $this->connection;
	}

}
