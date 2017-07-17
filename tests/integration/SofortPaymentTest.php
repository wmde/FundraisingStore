<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\Donation;
use WMDE\Fundraising\Entities\DonationPayments\SofortPayment;

/**
 * @covers \WMDE\Fundraising\Entities\DonationPayments\SofortPayment
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SofortPaymentTest extends TestCase {

	public function testPaymentWithOnlyId_isPersisted(): void {
		$donation = new Donation();
		$payment = new SofortPayment();
		$donation->setPayment( $payment );

		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( $donation );
		$entityManager->flush();

		/**
		 * @var $retrievedPayment SofortPayment
		 */
		$retrievedPayment = $entityManager->getRepository( SofortPayment::class )
			->findOneBy( [] );

		$this->assertSame( $payment->getId(), $retrievedPayment->getId() );
		$this->assertNull( $retrievedPayment->getConfirmedAt() );
	}

	public function testPaymentWithIdAndConfirmedAt_isPersisted(): void {
		$donation = new Donation();
		$payment = new SofortPayment();
		$payment->setConfirmedAt( new DateTime( '2017-07-14T22:00:01Z' ) );
		$donation->setPayment( $payment );

		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( $donation );
		$entityManager->flush();

		/**
		 * @var $retrievedPayment SofortPayment
		 */
		$retrievedPayment = $entityManager->getRepository( SofortPayment::class )
			->findOneBy( [] );

		$this->assertSame( $payment->getId(), $retrievedPayment->getId() );
		$this->assertEquals( new DateTime( '2017-07-14T22:00:01Z' ), $retrievedPayment->getConfirmedAt() );
	}
}
