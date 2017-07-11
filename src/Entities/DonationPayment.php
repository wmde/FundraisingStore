<?php
declare( strict_types=1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 6.0
 *
 * @ORM\Entity
 * @ORM\Table(name="donation_payment")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="payment_type", type="string", length=3)
 * @ORM\DiscriminatorMap({"SUB" = "WMDE\Fundraising\Entities\DonationPayments\SofortPayment"})
 */
abstract class DonationPayment {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @ORM\Id
	 */
	private $id;

	public function getId(): int {
		return $this->id;
	}

	public function setId( int $id ): void {
		$this->id = $id;
	}

}