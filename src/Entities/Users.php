<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 0.1
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="user_name", columns={"user_name"}), @ORM\UniqueConstraint(name="user_address", columns={"user_address"})})
 * @ORM\Entity
 */
class Users {
	/**
	 * @var string
	 *
	 * @ORM\Column(name="user_name", type="string", length=32, nullable=false)
	 */
	private $userName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="user_address", type="string", length=64, nullable=false)
	 */
	private $userAddress;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="user_pass", type="string", length=32, nullable=false)
	 */
	private $userPass;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="user_pass_expiry", type="datetime", options={"default":"1970-01-01 00:00:00"}, nullable=true)
	 */
	private $userPassExpiry = '1970-01-01 00:00:00';

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="user_pass_notification", type="boolean", nullable=true)
	 */
	private $userPassNotification;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="user_salt", type="string", length=8, nullable=false)
	 */
	private $userSalt;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="user_role", type="boolean", options={"default":0}, nullable=true)
	 */
	private $userRole = 0;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="user_active", type="boolean", options={"default":0}, nullable=true)
	 */
	private $userActive = 0;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="user_id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $userId;


	/**
	 * Set userName
	 *
	 * @param string $userName
	 * @return Users
	 */
	public function setUserName( $userName ) {
		$this->userName = $userName;

		return $this;
	}

	/**
	 * Get userName
	 *
	 * @return string
	 */
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * Set userAddress
	 *
	 * @param string $userAddress
	 * @return Users
	 */
	public function setUserAddress( $userAddress ) {
		$this->userAddress = $userAddress;

		return $this;
	}

	/**
	 * Get userAddress
	 *
	 * @return string
	 */
	public function getUserAddress() {
		return $this->userAddress;
	}

	/**
	 * Set userPass
	 *
	 * @param string $userPass
	 * @return Users
	 */
	public function setUserPass( $userPass ) {
		$this->userPass = $userPass;

		return $this;
	}

	/**
	 * Get userPass
	 *
	 * @return string
	 */
	public function getUserPass() {
		return $this->userPass;
	}

	/**
	 * Set userPassExpiry
	 *
	 * @param \DateTime $userPassExpiry
	 * @return Users
	 */
	public function setUserPassExpiry( $userPassExpiry ) {
		$this->userPassExpiry = $userPassExpiry;

		return $this;
	}

	/**
	 * Get userPassExpiry
	 *
	 * @return \DateTime
	 */
	public function getUserPassExpiry() {
		return $this->userPassExpiry;
	}

	/**
	 * Set userPassNotification
	 *
	 * @param boolean $userPassNotification
	 * @return Users
	 */
	public function setUserPassNotification( $userPassNotification ) {
		$this->userPassNotification = $userPassNotification;

		return $this;
	}

	/**
	 * Get userPassNotification
	 *
	 * @return boolean
	 */
	public function getUserPassNotification() {
		return $this->userPassNotification;
	}

	/**
	 * Set userSalt
	 *
	 * @param string $userSalt
	 * @return Users
	 */
	public function setUserSalt( $userSalt ) {
		$this->userSalt = $userSalt;

		return $this;
	}

	/**
	 * Get userSalt
	 *
	 * @return string
	 */
	public function getUserSalt() {
		return $this->userSalt;
	}

	/**
	 * Set userRole
	 *
	 * @param boolean $userRole
	 * @return Users
	 */
	public function setUserRole( $userRole ) {
		$this->userRole = $userRole;

		return $this;
	}

	/**
	 * Get userRole
	 *
	 * @return boolean
	 */
	public function getUserRole() {
		return $this->userRole;
	}

	/**
	 * Set userActive
	 *
	 * @param boolean $userActive
	 * @return Users
	 */
	public function setUserActive( $userActive ) {
		$this->userActive = $userActive;

		return $this;
	}

	/**
	 * Get userActive
	 *
	 * @return boolean
	 */
	public function getUserActive() {
		return $this->userActive;
	}

	/**
	 * Get userId
	 *
	 * @return integer
	 */
	public function getUserId() {
		return $this->userId;
	}
}
