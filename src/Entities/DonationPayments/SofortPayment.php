<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities\DonationPayments;

use Doctrine\ORM\Mapping as ORM;
use WMDE\Fundraising\Entities\DonationPayment;

/**
 * @since 6.0
 *
 * @ORM\Table(name="donation_payment_sofort")
 * @ORM\Entity
 */
class SofortPayment extends DonationPayment {

	/**
	 * @var string
	 * Example value: W-Q-ABCDEZ
	 *
	 * @ORM\Column(name="transfer_code", type="string", length=10, unique=true)
	 */
	private $bankTransferCode = '';

	public function __construct( string $bankTransferCode ) {
		$this->bankTransferCode = $bankTransferCode;
	}

	public function getBankTransferCode(): string {
		return $this->bankTransferCode;
	}

}
