<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 0.1
 *
 * @ORM\Table(name="action_log")
 * @ORM\Entity
 */
class ActionLog {
	/**
	 * @var \DateTime
	 *
	 * @ORM\Version
	 * @ORM\Column(name="al_timestamp", type="datetime", options={"default":0}, nullable=false)
	 */
	private $alTimestamp = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_type", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $alType = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_remote_addr", type="string", length=16, options={"default":""}, nullable=false)
	 */
	private $alRemoteAddr = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_session_id", type="string", length=32, options={"default":""}, nullable=false)
	 */
	private $alSessionId = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_username", type="string", length=45, options={"default":""}, nullable=false)
	 */
	private $alUsername = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_password", type="string", length=32, options={"default":""}, nullable=false)
	 */
	private $alPassword = '';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="al_id", type="integer", options={"unsigned"=true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $alId;


	public function __construct() {
		$this->setAlTimestamp( new \DateTime() );
	}

	/**
	 * Set alTimestamp
	 *
	 * @param \DateTime $alTimestamp
	 * @return self
	 */
	public function setAlTimestamp( $alTimestamp ) {
		$this->alTimestamp = $alTimestamp;

		return $this;
	}

	/**
	 * Get alTimestamp
	 *
	 * @return \DateTime
	 */
	public function getAlTimestamp() {
		return $this->alTimestamp;
	}

	/**
	 * Set alType
	 *
	 * @param string $alType
	 * @return self
	 */
	public function setAlType( $alType ) {
		$this->alType = $alType;

		return $this;
	}

	/**
	 * Get alType
	 *
	 * @return string
	 */
	public function getAlType() {
		return $this->alType;
	}

	/**
	 * Set alRemoteAddr
	 *
	 * @param string $alRemoteAddr
	 * @return self
	 */
	public function setAlRemoteAddr( $alRemoteAddr ) {
		$this->alRemoteAddr = $alRemoteAddr;

		return $this;
	}

	/**
	 * Get alRemoteAddr
	 *
	 * @return string
	 */
	public function getAlRemoteAddr() {
		return $this->alRemoteAddr;
	}

	/**
	 * Set alSessionId
	 *
	 * @param string $alSessionId
	 * @return self
	 */
	public function setAlSessionId( $alSessionId ) {
		$this->alSessionId = $alSessionId;

		return $this;
	}

	/**
	 * Get alSessionId
	 *
	 * @return string
	 */
	public function getAlSessionId() {
		return $this->alSessionId;
	}

	/**
	 * Set alUsername
	 *
	 * @param string $alUsername
	 * @return self
	 */
	public function setAlUsername( $alUsername ) {
		$this->alUsername = $alUsername;

		return $this;
	}

	/**
	 * Get alUsername
	 *
	 * @return string
	 */
	public function getAlUsername() {
		return $this->alUsername;
	}

	/**
	 * Set alPassword
	 *
	 * @param string $alPassword
	 * @return self
	 */
	public function setAlPassword( $alPassword ) {
		$this->alPassword = $alPassword;

		return $this;
	}

	/**
	 * Get alPassword
	 *
	 * @return string
	 */
	public function getAlPassword() {
		return $this->alPassword;
	}

	/**
	 * Get alId
	 *
	 * @return integer
	 */
	public function getAlId() {
		return $this->alId;
	}
}
