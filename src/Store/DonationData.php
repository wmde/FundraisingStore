<?php

namespace WMDE\Fundraising\Store;

/**
 * @since 2.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DonationData {

	private $accessToken;
	private $updateToken;
	private $updateTokenExpiry;

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
	 * @return string|null Time in 'Y-m-d H:i:s' format
	 */
	public function getUpdateTokenExpiry() {
		return $this->updateTokenExpiry;
	}

	/**
	 * @param string|null $updateTokenExpiry Time in 'Y-m-d H:i:s' format
	 */
	public function setUpdateTokenExpiry( $updateTokenExpiry ) {
		$this->updateTokenExpiry = $updateTokenExpiry;
	}

}
