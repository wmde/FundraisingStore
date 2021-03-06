<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\AddressChange;

/**
 * @covers WMDE\Fundraising\Entities\AddressChange
 */
class AddressChangeTest extends TestCase {

	/**
	 * @var EntityManager
	 */
	private $entityManager;

	public function setUp(): void {
		$this->entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
	}

	public function testWhenNewAddressChangeIsPersisted_uuidIsGeneratedAndStored() {
		$addressChange = AddressChange::newDonationAddressChange( AddressChange::ADDRESS_TYPE_PERSON, 1 );
		$this->entityManager->persist( $addressChange );
		$this->entityManager->flush();

		/** @var AddressChange $retrievedAddressChange */
		$retrievedAddressChange = $this->entityManager->getRepository( AddressChange::class )->findOneBy( [] );

		$this->assertSame( $addressChange->getCurrentIdentifier(), $retrievedAddressChange->getCurrentIdentifier() );
	}

	public function testWhenAddressIdentifierIsUpdated_dataIsProperlyAssigned() {
		$addressChange = AddressChange::newMembershipAddressChange( AddressChange::ADDRESS_TYPE_PERSON, 2 );
		$initialIdentifier = $addressChange->getCurrentIdentifier();
		$addressChange->updateAddressIdentifier();

		$this->assertSame( $initialIdentifier, $addressChange->getPreviousIdentifier() );
		$this->assertNotSame( $initialIdentifier, $addressChange->getCurrentIdentifier() );
	}
}
