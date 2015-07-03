<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\ActionLog;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class AutoloaderTest extends \PHPUnit_Framework_TestCase {

	public function testCanLoadEntities() {
		$this->assertInternalType( 'object', new ActionLog() );
	}

}
