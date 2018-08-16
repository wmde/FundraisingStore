<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\Address;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class AutoloaderTest extends TestCase {

	public function testCanLoadEntities() {
		$this->assertInternalType( 'object', new Address() );
	}

}
