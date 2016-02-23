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

	public function testCancelSetsDeletionDateAndStatus() {
		$donation = new Donation();

		$donation->cancel();

		$this->assertSame( 'D', $donation->getStatus() );
		$this->assertInternalType( 'string', $donation->getDtDel() );
	}

	public function testCancelModifiesData() {
		$donation = new Donation();

		$donation->encodeAndSetData( [
			'nyan' => 'cat'
		] );

		$donation->cancel();
		$data = $donation->getDecodedData();

		$this->assertSame( 'cat', $data['nyan'] );
		$this->assertSame( 'D', $data['status'] );
		$this->assertInternalType( 'string', $data['dt_del'] );
		$this->assertSame( '', $data['utoken'] );
	}

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
