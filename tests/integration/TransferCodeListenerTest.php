<?php

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\ORM\EntityManager;
use WMDE\Fundraising\Entities\Donation;

/**
 * @covers WMDE\Fundraising\Store\TransferCodeListener
 *
 * @licence GNU GPL v2+
 * @author Kai Nissen < kai.nissen@wikimedia.de >
 */
class TransferCodeListenerTest extends \PHPUnit_Framework_TestCase {

	/** @var EntityManager  */
	private $entityManager;

	public function setUp() {
		$this->entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
	}

	public function testGivenEmptyTransferCode_prePersistDoesNotInterfere() {
		$this->saveNewDonation( '' );

		/** @var Donation[] $dataSets */
		$dataSets = $this->entityManager->getRepository( Donation::class )->findAll();
		$this->assertEmpty( $dataSets[0]->getTransferCode() );
	}

	public function testGivenTransferCode_transferCodeGetsPersisted() {
		$this->saveNewDonation( 'testcode' );

		/** @var Donation[] $dataSets */
		$dataSets = $this->entityManager->getRepository( Donation::class )->findAll();
		$this->assertSame( 'testcode', $dataSets[0]->getTransferCode() );
	}

	public function testGivenAmbiguousTransferCode_prePersistGeneratesNewTransferCode() {
		$this->saveNewDonation( 'testcode' );
		$this->saveNewDonation( 'testcode' );

		/** @var Donation[] $dataSets */
		$dataSets = $this->entityManager->getRepository( Donation::class )->findAll();
		$this->assertNotSame( $dataSets[0]->getTransferCode(), $dataSets[1]->getTransferCode() );
	}

	/**
	 * @param $transferCode
	 */
	private function saveNewDonation( $transferCode ) {
		$donation = new Donation();
		$donation->setTransferCode( $transferCode );
		$donation->setPaymentType( 'UEB' );
		$this->entityManager->persist( $donation );
		$this->entityManager->flush();
	}
}
