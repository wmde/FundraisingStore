<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities\DonationPayments;

use DateTime;
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

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="confirmed_at", type="datetime", nullable=true)
	 */
	private $confirmedAt;

	public function __construct( string $bankTransferCode ) {
		$this->bankTransferCode = $bankTransferCode;
	}

	public function getBankTransferCode(): string {
		return $this->bankTransferCode;
	}

	public function getConfirmedAt(): ?DateTime {
		return $this->confirmedAt;
	}

	public function setConfirmedAt( DateTime $confirmedAt ) {
		$this->confirmedAt = $confirmedAt;
	}
}
