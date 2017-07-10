<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

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

	private const BANK_TRANSFER_CODE = 'W-Q-ABCDEZ';

	public function testPersistenceRoundTrip() {
		$donation = new Donation();
		$payment = new SofortPayment( self::BANK_TRANSFER_CODE );
		$donation->setPayment( $payment );
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();

		$entityManager->persist( $donation );
		$entityManager->flush();
		/**
		 * @var $retrievedPayment SofortPayment
		 */
		$retrievedPayment = $entityManager->getRepository( SofortPayment::class )
			->findOneByBankTransferCode( self::BANK_TRANSFER_CODE );

		$this->assertSame( self::BANK_TRANSFER_CODE, $retrievedPayment->getBankTransferCode() );
		$this->assertSame( $payment->getId(), $retrievedPayment->getId() );
	}

}
