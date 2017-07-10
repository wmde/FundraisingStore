<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\DonationPayments\SofortPayment;

/**
 * @covers WMDE\Fundraising\Entities\DonationPayments\SofortPayment
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SofortPaymentTest extends TestCase {

	private const BANK_TRANSFER_CODE = 'W-Q-ABCDEZ';
	private const DONATION_ID = 31337;

	public function testPersistenceRoundTrip() {
		$payment = new SofortPayment( self::BANK_TRANSFER_CODE, self::DONATION_ID );
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();

		$entityManager->persist( $payment );
		$entityManager->flush();
		/**
		 * @var $retrievedPayment SofortPayment
		 */
		$retrievedPayment = $entityManager->getRepository( SofortPayment::class )->find( self::BANK_TRANSFER_CODE );

		$this->assertSame( self::BANK_TRANSFER_CODE, $retrievedPayment->getBankTransferCode() );
		$this->assertSame( self::DONATION_ID, $retrievedPayment->getDonationId() );
	}

}
