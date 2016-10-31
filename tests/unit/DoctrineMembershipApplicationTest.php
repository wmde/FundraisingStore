<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\DoctrineMembershipApplication;
use WMDE\Fundraising\Store\MembershipApplicationData;

/**
 * @covers WMDE\Fundraising\Entities\DoctrineMembershipApplication
 * @covers WMDE\Fundraising\Store\MembershipApplicationData
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DoctrineMembershipApplicationTest extends \PHPUnit_Framework_TestCase {

	public function testWhenSettingIdToAnInteger_getIdReturnsIt() {
		$application = new DoctrineMembershipApplication();
		$application->setId( 1337 );

		$this->assertSame( 1337, $application->getId() );
	}

	public function testWhenSettingIdToNull_getIdReturnsNull() {
		$application = new DoctrineMembershipApplication();
		$application->setId( 1337 );
		$application->setId( null );

		$this->assertNull( $application->getId() );
	}

	public function testWhenIdIsNotSet_getIdReturnsNull() {
		$application = new DoctrineMembershipApplication();

		$this->assertNull( $application->getId() );
	}

	public function testGivenNoData_getDataObjectReturnsObjectWithNullValues() {
		$application = new DoctrineMembershipApplication();

		$this->assertNull( $application->getDataObject()->getAccessToken() );
		$this->assertNull( $application->getDataObject()->getUpdateToken() );
		$this->assertNull( $application->getDataObject()->getPreservedStatus() );
	}

	public function testWhenProvidingData_setDataObjectSetsData() {
		$data = new MembershipApplicationData();
		$data->setAccessToken( 'foo' );
		$data->setUpdateToken( 'bar' );
		$data->setPreservedStatus( 1337 );

		$application = new DoctrineMembershipApplication();
		$application->setDataObject( $data );

		$this->assertSame(
			[
				'token' => 'foo',
				'utoken' => 'bar',
				'old_status' => 1337,
			],
			$application->getDecodedData()
		);
	}

	public function testWhenProvidingNullData_setObjectDoesNotSetFields() {
		$application = new DoctrineMembershipApplication();
		$application->setDataObject( new MembershipApplicationData() );

		$this->assertSame(
			[],
			$application->getDecodedData()
		);
	}

	public function testWhenDataAlreadyExists_setDataObjectRetainsAndUpdatesData() {
		$application = new DoctrineMembershipApplication();
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
		$application = new DoctrineMembershipApplication();
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

	public function testStatusConstantsExist() {
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_MODERATION );
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_ABORTED );
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_CANCELED );
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_CONFIRMED );
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_DELETED );
		$this->assertNotNull( DoctrineMembershipApplication::STATUS_NEUTRAL );
	}

	public function testGivenModerationStatus_needsModerationReturnsTrue() {
		$application = new DoctrineMembershipApplication();
		$application->setStatus( DoctrineMembershipApplication::STATUS_MODERATION );

		$this->assertTrue( $application->needsModeration() );
	}

	public function testGivenDefaultStatus_needsModerationReturnsFalse() {
		$application = new DoctrineMembershipApplication();

		$this->assertFalse( $application->needsModeration() );
	}

	public function testGivenModerationAndCancelledStatus_needsModerationReturnsTrue() {
		$application = new DoctrineMembershipApplication();
		$application->setStatus(
			DoctrineMembershipApplication::STATUS_MODERATION + DoctrineMembershipApplication::STATUS_CANCELED
		);

		$this->assertTrue( $application->needsModeration() );
	}

	public function testGivenCancelledStatus_isCancelledReturnsTrue() {
		$application = new DoctrineMembershipApplication();
		$application->setStatus( DoctrineMembershipApplication::STATUS_CANCELED );

		$this->assertTrue( $application->isCancelled() );
	}

	public function testGivenDefaultStatus_isCancelledReturnsFalse() {
		$application = new DoctrineMembershipApplication();

		$this->assertFalse( $application->isCancelled() );
	}

	public function testGivenModerationAndCancelledStatus_isCancelledReturnsTrue() {
		$application = new DoctrineMembershipApplication();
		$application->setStatus(
			DoctrineMembershipApplication::STATUS_MODERATION + DoctrineMembershipApplication::STATUS_CANCELED
		);

		$this->assertTrue( $application->isCancelled() );
	}

}
