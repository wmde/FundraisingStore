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
	 * @var \DateTime
	 *
	 * @ORM\Column(name="export", type="datetime", nullable=true)
	 */
	private $export;

	/**
	 * @var \DateTime
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
	 * @var \DateTime
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;

	const STATUS_CONFIRMED = 1;
	const STATUS_NEUTRAL = 0;
	const STATUS_DELETED = -1;
	const STATUS_MODERATION = -2;
	const STATUS_ABORTED = -4;
	const STATUS_CANCELED = -8;


	/**
	 * Set name
	 *
	 * @param string $fullName
	 * @return self
	 */
	public function setFullName( $fullName ) {
		$this->fullName = $fullName;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getFullName() {
		return $this->fullName;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return self
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set export
	 *
	 * @param \DateTime $export
	 * @return self
	 */
	public function setExport( $export ) {
		$this->export = $export;

		return $this;
	}

	/**
	 * Get export
	 *
	 * @return \DateTime
	 */
	public function getExport() {
		return $this->export;
	}

	/**
	 * Set backup
	 *
	 * @param \DateTime $backup
	 * @return self
	 */
	public function setBackup( $backup ) {
		$this->backup = $backup;

		return $this;
	}

	/**
	 * Get backup
	 *
	 * @return \DateTime
	 */
	public function getBackup() {
		return $this->backup;
	}

	/**
	 * Set status
	 *
	 * @param integer $status
	 * @return self
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * Get status
	 *
	 * @return integer
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Set guid
	 *
	 * @param string $confirmationCode
	 * @return self
	 */
	public function setConfirmationCode( $confirmationCode ) {
		$this->confirmationCode = $confirmationCode;

		return $this;
	}

	/**
	 * Get guid
	 *
	 * @return string
	 */
	public function getConfirmationCode() {
		return $this->confirmationCode;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return Address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * @param \DateTime $createdAt
	 * @return self
	 */
	public function setCreatedAt( $createdAt ) {
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @param Address $address
	 */
	public function setAddress( $address ) {
		$this->address = $address;
	}

	public function isUnconfirmed() {
		return $this->getStatus() === self::STATUS_NEUTRAL;
	}

	public function getHexConfirmationCode() {
		return bin2hex( $this->confirmationCode );
	}

	public function setHexConfirmationCode( $confirmationCode ) {
		$this->confirmationCode = hex2bin( $confirmationCode );
	}

}
