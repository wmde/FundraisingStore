<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActionLog
 *
 * @ORM\Table(name="action_log")
 * @ORM\Entity
 */
class ActionLog {
	/**
	 * @var \DateTime
	 *
	 * @ORM\Version
	 * @ORM\Column(name="al_timestamp", type="datetime", nullable=false)
	 */
	private $alTimestamp;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_type", type="string", length=16, nullable=false)
	 */
	private $alType;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_remote_addr", type="string", length=16, nullable=false)
	 */
	private $alRemoteAddr;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_session_id", type="string", length=32, nullable=false)
	 */
	private $alSessionId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_username", type="string", length=45, nullable=false)
	 */
	private $alUsername;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="al_password", type="string", length=32, nullable=false)
	 */
	private $alPassword;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="al_id", type="integer", options={"unsigned"=true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $alId;


	/**
	 * Set alTimestamp
	 *
	 * @param \DateTime $alTimestamp
	 * @return ActionLog
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
	 * @return ActionLog
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
	 * @return ActionLog
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
	 * @return ActionLog
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
	 * @return ActionLog
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
	 * @return ActionLog
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
