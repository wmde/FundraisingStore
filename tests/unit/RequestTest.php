<?php


namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Inquiry;

class RequestTest extends \PHPUnit_Framework_TestCase
{
	public function testGivenOnlyAFirstname_theNameIsSetToFirstname() {
		$request = new Inquiry();
		$request->setFirstName( 'Douglas' );
		$this->assertEquals( 'Douglas', $request->getName() );
	}

	public function testGivenOnlyALastname_theNameIsSetToLastname() {
		$request = new Inquiry();
		$request->setLastName( 'Adams' );
		$this->assertEquals( 'Adams', $request->getName() );
	}

	public function testGivenFirstnameAndLastname_theFullNameIsSet() {
		$request = new Inquiry();
		$request->setFirstName( 'Douglas' );
		$request->setLastName( 'Adams' );
		$this->assertEquals( 'Douglas Adams', $request->getName() );
	}

	public function testFullNameCanBeSetSeparately() {
		$request = new Inquiry();
		$request->setFirstName( 'Douglas' );
		$request->setLastName( 'Adams' );
		$request->setName( 'Arthur Dent' );
		$this->assertEquals( 'Arthur Dent', $request->getName() );
	}

	public function testSettingFirstOrLastNameOverridesFullname() {
		$request = new Inquiry();
		$request->setName( 'Arthur Dent' );
		$request->setFirstName( 'Douglas' );
		$request->setLastName( 'Adams' );
		$this->assertEquals( 'Douglas Adams', $request->getName() );
	}
}
