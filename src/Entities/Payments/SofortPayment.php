<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities\Payments;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 6.0
 *
 * @ORM\Table(name="payment_sofort")
 * @ORM\Entity
 */
class SofortPayment {

	/**
	 * @var string
	 * Example value: W-Q-ABCDEZ
	 *
	 * @ORM\Column(name="transfer_code", type="string", length=10, unique=true)
	 * @ORM\Id
	 */
	private $bankTransferCode = '';

	/**
	 * @var integer
	 * Example value: 1337
	 *
	 * @ORM\Column(name="donation_id", type="integer", unique=true)
	 */
	private $donationId = '';

}
