<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\MembershipApplication;
use WMDE\Fundraising\Store\MembershipApplicationData;

/**
 * @covers WMDE\Fundraising\Entities\MembershipApplication
 * @covers WMDE\Fundraising\Store\MembershipApplicationData
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MembershipApplicationTest extends \PHPUnit_Framework_TestCase {

	public function testWhenSettingIdToAnInteger_getIdReturnsIt() {
		$application = new MembershipApplication();
		$application->setId( 1337 );

		$this->assertSame( 1337, $application->getId() );
	}

	public function testWhenSettingIdToNull_getIdReturnsNull() {
		$application = new MembershipApplication();
		$application->setId( 1337 );
		$application->setId( null );

		$this->assertNull( $application->getId() );
	}

	public function testWhenIdIsNotSet_getIdReturnsNull() {
		$application = new MembershipApplication();

		$this->assertNull( $application->getId() );
	}

	public function testGivenNoData_getDataObjectReturnsObjectWithNullValues() {
		$application = new MembershipApplication();

		$this->assertNull( $application->getDataObject()->getAccessToken() );
		$this->assertNull( $application->getDataObject()->getUpdateToken() );
	}

	public function testWhenProvidingData_setDataObjectSetsData() {
		$data = new MembershipApplicationData();
		$data->setAccessToken( 'foo' );
		$data->setUpdateToken( 'bar' );

		$application = new MembershipApplication();
		$application->setDataObject( $data );

		$this->assertSame(
			[
				'token' => 'foo',
				'utoken' => 'bar',
			],
			$application->getDecodedData()
		);
	}

	public function testWhenProvidingNullData_setObjectDoesNotSetFields() {
		$application = new MembershipApplication();
		$application->setDataObject( new MembershipApplicationData() );

		$this->assertSame(
			[],
			$application->getDecodedData()
		);
	}

	public function testWhenDataAlreadyExists_setDataObjectRetainsAndUpdatesData() {
		$application = new MembershipApplication();
		$application->encodeAndSetData( [
			'nyan' => 'cat',
			'token' => 'wee',
			'pink' => 'fluffy',
		] );

		$data = new MembershipApplicationData();
		$data->setAccessToken( 'foo' );
		$data->setUpdateToken( 'bar' );

		$application->setDataObject( $data );

		$this->assertSame(
			[
				'nyan' => 'cat',
				'token' => 'foo',
				'pink' => 'fluffy',
				'utoken' => 'bar',
			],
			$application->getDecodedData()
		);
	}

	public function testWhenModifyingTheDataObject_modificationsAreReflected() {
		$application = new MembershipApplication();
		$application->encodeAndSetData( [
			'nyan' => 'cat',
			'token' => 'wee',
			'pink' => 'fluffy',
		] );

		$application->modifyDataObject( function( MembershipApplicationData $data ) {
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
			$application->getDecodedData()
		);
	}

}
