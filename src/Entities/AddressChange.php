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
 *     	@ORM\Index(name="ac_export_date", columns={"export_date"}),
 *      @ORM\Index(name="ac_ext_id", columns={"external_id_type", "external_id"})
 *     }
 * )
 * @ORM\Entity
 */
class AddressChange {

	public const ADDRESS_TYPE_PERSON = 'person';

	public const ADDRESS_TYPE_COMPANY = 'company';

	public const EXTERNAL_ID_TYPE_DONATION = 'donation';

	public const EXTERNAL_ID_TYPE_MEMBERSHIP = 'membership';

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
	 * @var int
	 *
	 * @ORM\Column(name="external_id", type="integer")
	 */
	private $externalId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="external_id_type", type="string", length=10 )
	 */
	private $externalIdType;

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


	private function __construct( string $addressType, string $externalIdType, int $externalId ) {
		$this->createdAt = new \DateTime();
		$this->modifiedAt = new \DateTime();
		$this->addressType = $addressType;
		$this->externalIdType = $externalIdType;
		$this->externalId = $externalId;
		if ($this->identifier === null) {
			$this->generateUuid();
		}
	}

	public static function newDonationAddressChange( string $addressType, int $donationId ): self {
		return new self( $addressType, self::EXTERNAL_ID_TYPE_DONATION, $donationId );
	}

	public static function newMembershipAddressChange( string $addressType, int $membershipId ): self {
		return new self( $addressType, self::EXTERNAL_ID_TYPE_MEMBERSHIP, $membershipId );
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
