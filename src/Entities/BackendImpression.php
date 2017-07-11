<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 2.0
 *
 * @ORM\Table(
 *   name="backend_impressions",
 *   indexes={
 *     @ORM\Index(name="idx_banner_id", columns={"banner_id"}),
 *     @ORM\Index(name="idx_banner_id_datetime", columns={"banner_id", "datetime"})
 *   }
 * )
 * @ORM\Entity
 */
class BackendImpression {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="banner_id", type="integer",  options={"unsigned"=true}, options={"default":0}, nullable=false)
	 */
	private $bannerId = 0;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="datetime", type="datetime", options={"default":"1970-01-01 00:00:00"}, nullable=false)
	 */
	private $datetime = '1970-01-01 00:00:00';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="imp_count", type="integer",  options={"unsigned"=true}, options={"default":0}, nullable=false)
	 */
	private $impCount = 0;

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
	 * @return self
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
	 * @return self
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
	 * @return self
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
