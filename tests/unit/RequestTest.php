<?php


namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
	public function testGivenOnlyAFirstname_theNameIsSetToFirstname() {
		$request = new Request();
		$request->setVorname( 'Douglas' );
		$this->assertEquals( 'Douglas', $request->getName() );
	}

	public function testGivenOnlyALastname_theNameIsSetToLastname() {
		$request = new Request();
		$request->setNachname( 'Adams' );
		$this->assertEquals( 'Adams', $request->getName() );
	}

	public function testGivenFirstnameAndLastname_theFullNameIsSet() {
		$request = new Request();
		$request->setVorname( 'Douglas' );
		$request->setNachname( 'Adams' );
		$this->assertEquals( 'Douglas Adams', $request->getName() );
	}

	public function testFullNameCanBeSetSeparately() {
		$request = new Request();
		$request->setVorname( 'Douglas' );
		$request->setNachname( 'Adams' );
		$request->setName( 'Arthur Dent' );
		$this->assertEquals( 'Arthur Dent', $request->getName() );
	}

	public function testSettingFirstOrLastNameOverridesFullname() {
		$request = new Request();
		$request->setName( 'Arthur Dent' );
		$request->setVorname( 'Douglas' );
		$request->setNachname( 'Adams' );
		$this->assertEquals( 'Douglas Adams', $request->getName() );
	}
}
