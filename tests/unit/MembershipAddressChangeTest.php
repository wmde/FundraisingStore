<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\AddressChange;
use WMDE\Fundraising\Entities\MembershipApplication;

/**
 * @covers WMDE\Fundraising\Entities\AddressChange
 */
class MembershipAddressChangeTest extends TestCase {

	/**
	 * @var EntityManager
	 */
	private $entityManager;

	public function setUp(): void {
		$this->entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
	}

	public function testWhenMembershipApplicationIsCreated_addressChangeUuidIsStored(): void {
		$application = new MembershipApplication();
		$application->setAddressChange( new AddressChange( AddressChange::ADDRESS_TYPE_PERSON ) );

		$oldId = $application->getAddressChange()->getCurrentIdentifier();
		$this->entityManager->persist( $application );
		$this->entityManager->flush();

		/** @var MembershipApplication $persistedApplication */
		$persistedApplication = $this->entityManager->find( MembershipApplication::class, 1 );
		$this->assertSame(
			$oldId,
			$persistedApplication->getAddressChange()->getCurrentIdentifier()
		);
	}

	public function testWhenAddressIsUpdated_addressChangeUuidIsUpdated(): void {
		$application = new MembershipApplication();
		$application->setAddressChange( new AddressChange( AddressChange::ADDRESS_TYPE_COMPANY ) );

		$oldId = $application->getAddressChange()->getCurrentIdentifier();

		$this->entityManager->persist( $application );
		$this->entityManager->flush();

		/** @var MembershipApplication $persistedApplication */
		$persistedApplication = $this->entityManager->find( MembershipApplication::class, 1 );

		$this->assertNull( $persistedApplication->getAddressChange()->getPreviousIdentifier() );

		$persistedApplication->getAddressChange()->updateAddressIdentifier();

		$this->assertNotSame( $oldId, $persistedApplication->getAddressChange()->getCurrentIdentifier() );
		$this->assertSame( $oldId, $persistedApplication->getAddressChange()->getPreviousIdentifier() );
	}
}
