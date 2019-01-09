<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\AddressChange;
use WMDE\Fundraising\Entities\Donation;

/**
 * @covers WMDE\Fundraising\Entities\AddressChange
 */
class DonationAddressChangeTest extends TestCase {

	/**
	 * @var EntityManager
	 */
	private $entityManager;

	public function setUp(): void {
		$this->entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
	}

	public function testWhenDonationIsCreated_addressChangeUuidIsStored(): void {
		$donation = new Donation();
		$donation->setAddressChange( new AddressChange( AddressChange::ADDRESS_TYPE_PERSON ) );

		$oldId = $donation->getAddressChange()->getCurrentIdentifier();
		$this->entityManager->persist( $donation );
		$this->entityManager->flush();

		/** @var Donation $persistedDonation */
		$persistedDonation = $this->entityManager->find( Donation::class, 1 );
		$this->assertSame(
			$oldId,
			$persistedDonation->getAddressChange()->getCurrentIdentifier()
		);
	}

	public function testWhenAddressIsUpdated_addressChangeUuidIsUpdated(): void {
		$donation = new Donation();
		$donation->setAddressChange( new AddressChange( AddressChange::ADDRESS_TYPE_COMPANY ) );

		$oldId = $donation->getAddressChange()->getCurrentIdentifier();

		$this->entityManager->persist( $donation );
		$this->entityManager->flush();

		/** @var Donation $persistedDonation */
		$persistedDonation = $this->entityManager->find( Donation::class, 1 );

		$this->assertNull( $persistedDonation->getAddressChange()->getPreviousIdentifier() );

		$persistedDonation->getAddressChange()->updateAddressIdentifier();

		$this->assertNotSame( $oldId, $persistedDonation->getAddressChange()->getCurrentIdentifier() );
		$this->assertSame( $oldId, $persistedDonation->getAddressChange()->getPreviousIdentifier() );
	}
}
