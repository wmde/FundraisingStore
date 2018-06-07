<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\AddressChange;

/**
 * @covers WMDE\Fundraising\Entities\AddressChange
 */
class AddressChangeTest extends TestCase {

	public function testWhenNewAddressChangeIsPersisted_uuidIsGeneratedAndStored() {
		$addressChange = new AddressChange();
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( $addressChange );
		$entityManager->flush();

		/** @var AddressChange $retrievedAddressChange */
		$retrievedAddressChange = $entityManager->getRepository( AddressChange::class )->findOneBy( [] );

		$this->assertSame( $addressChange->getCurrentIdentifier(), $retrievedAddressChange->getCurrentIdentifier() );
	}

	public function testWhenAddressIdentifierIsUpdated_dataIsProperlyAssigned() {
		$addressChange = new AddressChange();
		$initialIdentifier = $addressChange->getCurrentIdentifier();
		$addressChange->updateAddressIdentifier();

		$this->assertSame( $initialIdentifier, $addressChange->getPreviousIdentifier() );
		$this->assertNotSame( $initialIdentifier, $addressChange->getCurrentIdentifier() );
	}
}
