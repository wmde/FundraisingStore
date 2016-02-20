<?php

namespace WMDE\Fundraising\Store;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WMDE\Fundraising\Entities\Donation;

/**
 * @licence GNU GPL v2+
 * @author Kai Nissen < kai.nissen@wikimedia.de >
 */
class TransferCodeListener {

	private $transferCodeGenerator;

	public function __construct( TransferCodeGenerator $transferCodeGenerator ) {
		$this->transferCodeGenerator = $transferCodeGenerator;
	}

	public function prePersist( LifecycleEventArgs $args ) {
		$entity = $args->getObject();
		$entityManager = $args->getObjectManager();

		if ( $entity instanceof Donation && !empty( $entity->getTransferCode() ) ) {
			$donationRepository = $entityManager->getRepository( Donation::class );
			while ( true ) {
				$dataSets = $donationRepository->findBy( [ 'transferCode' => $entity->getTransferCode() ] );

				if ( count( $dataSets ) === 0 ) {
					break;
				}

				$entity->setTransferCode( $this->transferCodeGenerator->generateTransferCode() );
			}
		}
	}

}