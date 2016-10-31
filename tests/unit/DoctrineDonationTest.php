<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\DoctrineDonation;
use WMDE\Fundraising\Store\DonationData;

/**
 * @covers WMDE\Fundraising\Entities\DoctrineDonation
 * @covers WMDE\Fundraising\Store\DonationData
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DoctrineDonationTest extends \PHPUnit_Framework_TestCase {

	public function testDataEncodingAndDecodingRoundtrips() {
		$donation = new DoctrineDonation();

		$someData = [
			'nyan' => 'cat',
			'foo' => null,
			'bar' => 9000.01,
			'baz' => [ true ]
		];

		$donation->encodeAndSetData( $someData );

		$this->assertSame( $someData, $donation->getDecodedData() );
	}

	public function testGivenNoData_getDecodedDataReturnsEmptyArray() {
		$donation = new DoctrineDonation();

		$this->assertSame( [], $donation->getDecodedData() );
	}

	public function testWhenSettingIdToAnInteger_getIdReturnsIt() {
		$donation = new DoctrineDonation();
		$donation->setId( 1337 );

		$this->assertSame( 1337, $donation->getId() );
	}

	public function testWhenSettingIdToNull_getIdReturnsNull() {
		$donation = new DoctrineDonation();
		$donation->setId( 1337 );
		$donation->setId( null );

		$this->assertNull( $donation->getId() );
	}

	public function testWhenIdIsNotSet_getIdReturnsNull() {
		$donation = new DoctrineDonation();

		$this->assertNull( $donation->getId() );
	}

	public function testGivenNoData_getDataObjectReturnsObjectWithNullValues() {
		$donation = new DoctrineDonation();

		$this->assertNull( $donation->getDataObject()->getAccessToken() );
		$this->assertNull( $donation->getDataObject()->getUpdateToken() );
		$this->assertNull( $donation->getDataObject()->getUpdateTokenExpiry() );
	}

	public function testGivenData_getDataObjectReturnsTheValues() {
		$donation = new DoctrineDonation();
		$donation->encodeAndSetData( [
			'token' => 'foo',
			'utoken' => 'bar',
			'uexpiry' => 'baz',
		] );

		$this->assertSame( 'foo', $donation->getDataObject()->getAccessToken() );
		$this->assertSame( 'bar', $donation->getDataObject()->getUpdateToken() );
		$this->assertSame( 'baz', $donation->getDataObject()->getUpdateTokenExpiry() );
	}

	public function testWhenProvidingData_setDataObjectSetsData() {
		$data = new DonationData();
		$data->setAccessToken( 'foo' );
		$data->setUpdateToken( 'bar' );
		$data->setUpdateTokenExpiry( 'baz' );

		$donation = new DoctrineDonation();
		$donation->setDataObject( $data );

		$this->assertSame(
			[
				'token' => 'foo',
				'utoken' => 'bar',
				'uexpiry' => 'baz',
			],
			$donation->getDecodedData()
		);
	}

	public function testWhenProvidingNullData_setObjectDoesNotSetFields() {
		$donation = new DoctrineDonation();
		$donation->setDataObject( new DonationData() );

		$this->assertSame(
			[],
			$donation->getDecodedData()
		);
	}

	public function testWhenDataAlreadyExists_setDataObjectRetainsAndUpdatesData() {
		$donation = new DoctrineDonation();
		$donation->encodeAndSetData( [
			'nyan' => 'cat',
			'token' => 'wee',
			'pink' => 'fluffy',
		] );

		$data = new DonationData();
		$data->setAccessToken( 'foo' );
		$data->setUpdateToken( 'bar' );

		$donation->setDataObject( $data );

		$this->assertSame(
			[
				'nyan' => 'cat',
				'token' => 'foo',
				'pink' => 'fluffy',
				'utoken' => 'bar',
			],
			$donation->getDecodedData()
		);
	}

	public function testWhenModifyingTheDataObject_modificationsAreReflected() {
		$donation = new DoctrineDonation();
		$donation->encodeAndSetData( [
			'nyan' => 'cat',
			'token' => 'wee',
			'pink' => 'fluffy',
		] );

		$donation->modifyDataObject( function( DonationData $data ) {
			$data->setAccessToken( 'foo' );
			$data->setUpdateToken( 'bar' );
		} );

		$this->assertSame(
			[
				'nyan' => 'cat',
				'token' => 'foo',
				'pink' => 'fluffy',
				'utoken' => 'bar',
			],
			$donation->getDecodedData()
		);
	}

	public function testStatusConstantsExist() {
		$this->assertNotNull( DoctrineDonation::STATUS_NEW );
		$this->assertNotNull( DoctrineDonation::STATUS_CANCELLED );
		$this->assertNotNull( DoctrineDonation::STATUS_EXTERNAL_BOOKED );
		$this->assertNotNull( DoctrineDonation::STATUS_EXTERNAL_INCOMPLETE );
		$this->assertNotNull( DoctrineDonation::STATUS_MODERATION );
		$this->assertNotNull( DoctrineDonation::STATUS_PROMISE );
	}

}
