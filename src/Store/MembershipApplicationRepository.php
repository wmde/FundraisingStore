<?php

namespace WMDE\Fundraising\Store;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use WMDE\Fundraising\Entities\MembershipApplication;

/**
 * @since 2.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MembershipApplicationRepository {

	private $entityManager;

	public function __construct( EntityManager $entityManager ) {
		$this->entityManager = $entityManager;
	}

	/**
	 * @param int $applicationId
	 *
	 * @return MembershipApplication|null
	 * @throws MembershipApplicationRepositoryException
	 */
	public function getApplicationOrNullById( $applicationId ) {
		try {
			$application = $this->entityManager->find( MembershipApplication::class, $applicationId );
		}
		catch ( ORMException $ex ) {
			throw new MembershipApplicationRepositoryException( 'Membership application could not be accessed' );
		}

		return $application;
	}

	/**
	 * @param int $applicationId
	 *
	 * @return MembershipApplication
	 * @throws MembershipApplicationRepositoryException
	 */
	public function getApplicationById( $applicationId ) {
		$application = $this->getApplicationOrNullById( $applicationId );

		if ( $application === null ) {
			throw new MembershipApplicationRepositoryException( 'Membership application does not exist' );
		}

		return $application;
	}

	/**
	 * @param MembershipApplication $application
	 *
	 * @throws MembershipApplicationRepositoryException
	 */
	public function persistApplication( MembershipApplication $application ) {
		try {
			$this->entityManager->persist( $application );
		}
		catch ( ORMException $ex ) {
			throw new MembershipApplicationRepositoryException( 'Failed to persist membership application' );
		}
	}

	/**
	 * @param int $applicationId
	 * @param callable $modificationFunction
	 *
	 * @throws MembershipApplicationRepositoryException
	 */
	public function modifyApplication( $applicationId, callable $modificationFunction ) {
		$application = $this->getApplicationById( $applicationId );

		$modificationFunction( $application );

		$this->persistApplication( $application );
	}

	/**
	 * @throws MembershipApplicationRepositoryException
	 */
	public function flush() {
		try {
			$this->entityManager->flush();
		}
		catch ( ORMException $ex ) {
			throw new MembershipApplicationRepositoryException( 'Failed to persist membership application' );
		}
	}

}
