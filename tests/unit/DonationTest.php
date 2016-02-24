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

	public function testWhenSettingIdToAnInteger_getIdReturnsIt() {
		$donation = new Donation();
		$donation->setId( 1337 );

		$this->assertSame( 1337, $donation->getId() );
	}

	public function testWhenSettingIdToNull_getIdReturnsNull() {
		$donation = new Donation();
		$donation->setId( 1337 );
		$donation->setId( null );

		$this->assertNull( $donation->getId() );
	}

	public function testWhenIdIsNotSet_getIdReturnsNull() {
		$donation = new Donation();

		$this->assertNull( $donation->getId() );
	}

}
