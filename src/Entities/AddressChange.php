<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @since 8.0
 *
 * @ORM\Table(
 *     name="address_change",
 *     indexes={
 *     	@ORM\Index(name="ac_export_date", columns={"export_date"})
 *     }
 * )
 * @ORM\Entity
 */
class AddressChange {

	public const ADDRESS_TYPE_PERSON = 'person';

	public const ADDRESS_TYPE_COMPANY = 'company';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Address")
	 * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
	 */
	private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="current_identifier", type="string", length=36, nullable=true, unique=true)
	 */
	private $identifier;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="previous_identifier", type="string", length=36, nullable=true, unique=true)
	 */
	private $previousIdentifier;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="address_type", type="string", length = 10)
	 */
	private $addressType;

	/**
	 * Date of last export
	 *
	 * No getter / setter needed -> read access is in AddressChange repo and update in exporter code
	 *
	 * @var \DateTime
	 *
	 * @ORM\Column(name="export_date", type="datetime", nullable=true)
	 */
	private $exportDate;

	/**
	 * When this was created
	 *
	 * No getter / setter needed, modification is in AddressChange repo
	 *
	 * @var \DateTime
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	/**
	 * When this was last modified
	 *
	 * No getter / setter needed, modification is in AddressChange repo
	 *
	 * @var \DateTime
	 * @ORM\Column(name="modified_at", type="datetime")
	 */
	private $modifiedAt;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="donation_receipt", type="boolean", nullable=false)
	 */
	private $donationReceipt = true;


	public function __construct( string $addressType ) {
		$this->createdAt = new \DateTime();
		$this->modifiedAt = new \DateTime();
		$this->addressType = $addressType;
		if ($this->identifier === null) {
			$this->generateUuid();
		}
	}

	private function generateUuid(): void {
		$this->identifier = Uuid::uuid4()->toString();
	}

	public function updateAddressIdentifier(): void {
		$this->previousIdentifier = $this->getCurrentIdentifier();
		$this->generateUuid();
	}

	public function getCurrentIdentifier(): string {
		if ($this->identifier === null) {
			$this->generateUuid();
		}
		return $this->identifier;
	}

	public function getPreviousIdentifier(): ?string {
		return $this->previousIdentifier;
	}

	public function isOptedIntoDonationReceipt() {
		return $this->donationReceipt;
	}

	public function setDonationReceipt( $donationReceipt ) {
		$this->donationReceipt = $donationReceipt;
	}

	public function getAddress(): ?Address {
		return $this->address;
	}

	public function setAddress( Address $address ) {
		$this->address = $address;
	}

	public function getAddressType(): string {
		return $this->addressType;
	}
}
