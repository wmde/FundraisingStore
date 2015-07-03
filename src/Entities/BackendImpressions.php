<?php

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * BackendImpressions
 *
 * @ORM\Table(name="backend_impressions", indexes={@ORM\Index(name="idx_banner_id", columns={"banner_id"}), @ORM\Index(name="idx_banner_id_datetime", columns={"banner_id", "datetime"})})
 * @ORM\Entity
 */
class BackendImpressions {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="banner_id", type="integer",  options={"unsigned"=true}, nullable=false)
	 */
	private $bannerId;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="datetime", type="datetime", nullable=false)
	 */
	private $datetime;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="imp_count", type="integer",  options={"unsigned"=true}, nullable=false)
	 */
	private $impCount;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="imp_id", type="integer", options={"unsigned"=true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $impId;


	/**
	 * Set bannerId
	 *
	 * @param integer $bannerId
	 * @return BackendImpressions
	 */
	public function setBannerId( $bannerId ) {
		$this->bannerId = $bannerId;

		return $this;
	}

	/**
	 * Get bannerId
	 *
	 * @return integer
	 */
	public function getBannerId() {
		return $this->bannerId;
	}

	/**
	 * Set datetime
	 *
	 * @param \DateTime $datetime
	 * @return BackendImpressions
	 */
	public function setDatetime( $datetime ) {
		$this->datetime = $datetime;

		return $this;
	}

	/**
	 * Get datetime
	 *
	 * @return \DateTime
	 */
	public function getDatetime() {
		return $this->datetime;
	}

	/**
	 * Set impCount
	 *
	 * @param integer $impCount
	 * @return BackendImpressions
	 */
	public function setImpCount( $impCount ) {
		$this->impCount = $impCount;

		return $this;
	}

	/**
	 * Get impCount
	 *
	 * @return integer
	 */
	public function getImpCount() {
		return $this->impCount;
	}

	/**
	 * Get impId
	 *
	 * @return integer
	 */
	public function getImpId() {
		return $this->impId;
	}
}
