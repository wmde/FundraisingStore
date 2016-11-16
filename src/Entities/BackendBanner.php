<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @since 0.1
 *
 * @ORM\Table(name="backend_banner", indexes={@ORM\Index(name="idx_cn_name", columns={"cn_name"}), @ORM\Index(name="idx_keyword", columns={"keyword"})})
 * @ORM\Entity
 */
class BackendBanner {
	/**
	 * @var string
	 *
	 * @ORM\Column(name="cn_name", type="string", length=100, options={"default":""}, nullable=false)
	 */
	private $cnName = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="layout", type="string", length=100, options={"default":""}, nullable=false)
	 */
	private $layout = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="campaign", type="string", length=100, options={"default":""}, nullable=false)
	 */
	private $campaign = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="keyword", type="string", length=100, options={"default":""}, nullable=false)
	 */
	private $keyword = '';

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="banner_id", type="integer", options={"unsigned"=true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $bannerId;


	/**
	 * Set cnName
	 *
	 * @param string $cnName
	 * @return self
	 */
	public function setCnName( $cnName ) {
		$this->cnName = $cnName;

		return $this;
	}

	/**
	 * Get cnName
	 *
	 * @return string
	 */
	public function getCnName() {
		return $this->cnName;
	}

	/**
	 * Set layout
	 *
	 * @param string $layout
	 * @return self
	 */
	public function setLayout( $layout ) {
		$this->layout = $layout;

		return $this;
	}

	/**
	 * Get layout
	 *
	 * @return string
	 */
	public function getLayout() {
		return $this->layout;
	}

	/**
	 * Set campaign
	 *
	 * @param string $campaign
	 * @return self
	 */
	public function setCampaign( $campaign ) {
		$this->campaign = $campaign;

		return $this;
	}

	/**
	 * Get campaign
	 *
	 * @return string
	 */
	public function getCampaign() {
		return $this->campaign;
	}

	/**
	 * Set keyword
	 *
	 * @param string $keyword
	 * @return self
	 */
	public function setKeyword( $keyword ) {
		$this->keyword = $keyword;

		return $this;
	}

	/**
	 * Get keyword
	 *
	 * @return string
	 */
	public function getKeyword() {
		return $this->keyword;
	}

	/**
	 * Get bannerId
	 *
	 * @return integer
	 */
	public function getBannerId() {
		return $this->bannerId;
	}
}
