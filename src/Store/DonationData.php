<?php

namespace WMDE\Fundraising\Store;

/**
 * @since 2.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DonationData {

	private $token;
	private $updateToken;
	private $updateTokenExpiry;

	/**
	 * @return string|null
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string|null $token
	 */
	public function setToken( $token ) {
		$this->token = $token;
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
