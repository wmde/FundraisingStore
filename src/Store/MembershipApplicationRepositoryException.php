<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store;

/**
 * @since 2.0
 *
 * @license GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MembershipApplicationRepositoryException extends \RuntimeException {

	public function __construct( $message, \Exception $previous = null ) {
		parent::__construct( $message, 0, $previous );
	}

}
