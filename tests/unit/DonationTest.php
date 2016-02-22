<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Donation;

/**
 * @covers WMDE\Fundraising\Entities\Donation
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DonationTest extends \PHPUnit_Framework_TestCase {

	public function testDataEncodingAndDecodingRoundtrips() {
		$donation = new Donation();

		$someData = [
			'nyan' => 'cat',
			'foo' => null,
			'bar' => 9000.01,
			'baz' => [ true ]
		];

		$donation->encodeAndSetData( $someData );

		$this->assertSame( $someData, $donation->getDecodedData() );
	}

}
