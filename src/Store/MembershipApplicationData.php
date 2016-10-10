<?php

namespace WMDE\Fundraising\Store;

/**
 * @since 2.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MembershipApplicationData {

	private $accessToken;
	private $updateToken;
	private $preservedStatus;

	/**
	 * @return string|null
	 */
	public function getAccessToken() {
		return $this->accessToken;
	}

	/**
	 * @param string|null $token
	 */
	public function setAccessToken( $token ) {
		$this->accessToken = $token;
	}

	/**
	 * @return string|null
	 */
	public function getUpdateToken() {
		return $this->updateToken;
	}

	/**
	 * @param string|null $updateToken
	 */
	public function setUpdateToken( $updateToken ) {
		$this->updateToken = $updateToken;
	}

	/**
	 * @since 2.1
	 * @return int|null
	 */
	public function getPreservedStatus() {
		return $this->preservedStatus;
	}

	/**
	 * @since 2.1
	 * @param string|null $status
	 */
	public function setPreservedStatus( $status ) {
		$this->preservedStatus = $status;
	}

}
