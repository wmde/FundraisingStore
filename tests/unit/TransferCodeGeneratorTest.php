<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Store\TransferCodeGenerator;

/**
 * @covers WMDE\Fundraising\Store\TransferCodeGenerator
 *
 * @licence GNU GPL v2+
 * @author Kai Nissen < kai.nissen@wikimedia.de >
 */
class TransferCodeGeneratorTest extends \PHPUnit_Framework_TestCase {

	public function testGenerateBankTransferCode_matchesRegex() {
		$generator = new TransferCodeGenerator();
		$this->assertRegExp( '/W-Q-[A-Z]{6}-[A-Z]/', $generator->generateTransferCode() );
	}

}
