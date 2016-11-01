<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @since 2.0
 *
 * @ORM\Table( name="subscription" )
 * @ORM\Entity
 */
class Subscription {

	/**
	 * @var string
	 *
	 * @ORM\Column(name="full_name", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $fullName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=250, options={"default":""}, nullable=false)
	 */
	private $email = '';

	/**
	 * @var \DateTime|null
	 *
	 * @ORM\Column(name="export", type="datetime", nullable=true)
	 */
	private $export;

	/**
	 * @var \DateTime|null
	 *
	 * @ORM\Column(name="backup", type="datetime", nullable=true)
	 */
	private $backup;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="status", type="smallint", options={"default":0}, nullable=true)
	 */
	private $status = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="confirmationCode", type="blob", length=16, nullable=true)
	 */
	private $confirmationCode;

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
	 * @ORM\Column(name="tracking", type="string", length=50, nullable=true)
	 */
	private $tracking;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="source", type="string", length=50, nullable=true)
	 */
	private $source;

	/**
	 * @var \DateTime
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;

	/* public */ const STATUS_NEW = 0;
	/* public */ const STATUS_CONFIRMED = 1;
	/* public */ const STATUS_MODERATION = 2;

	public function setFullName( string $fullName ): self {
		$this->fullName = $fullName;

		return $this;
	}

	public function getFullName(): string {
		return $this->fullName;
	}

	public function setEmail( string $email ): self {
		$this->email = $email;

		return $this;
	}

	public function getEmail(): string {
		return $this->email;
	}

	public function setExport( \DateTime $export = null ): self {
		$this->export = $export;

		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getExport() {
		return $this->export;
	}

	public function setBackup( \DateTime $backup = null ): self {
		$this->backup = $backup;

		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getBackup() {
		return $this->backup;
	}

	public function setStatus( int $status ): self {
		$this->status = $status;

		return $this;
	}

	public function getStatus(): int {
		return $this->status;
	}

	public function setConfirmationCode( string $confirmationCode ): self {
		$this->confirmationCode = $confirmationCode;

		return $this;
	}

	public function getConfirmationCode(): string {
		return $this->confirmationCode;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getAddress(): Address {
		return $this->address;
	}

	public function setAddress( Address $address ) {
		$this->address = $address;
	}

	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}

	public function setCreatedAt( \DateTime $createdAt ): self {
		$this->createdAt = $createdAt;
		return $this;
	}

	public function getTracking(): string {
		return $this->tracking;
	}

	public function setTracking( string $tracking ) {
		$this->tracking = $tracking;
	}

	public function isUnconfirmed(): bool {
		return $this->getStatus() === self::STATUS_NEW;
	}

	public function getHexConfirmationCode(): string {
		return bin2hex( $this->confirmationCode );
	}

	public function setHexConfirmationCode( string $confirmationCode ) {
		$this->confirmationCode = hex2bin( $confirmationCode );
	}

	public function setSource( string $source ): self {
		$this->source = $source;

		return $this;
	}

	public function getSource(): string {
		return $this->source;
	}

}
