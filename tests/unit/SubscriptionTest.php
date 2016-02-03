<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Subscription;

class SubscriptionTest extends \PHPUnit_Framework_TestCase {

	public function testGivenABinaryConfirmationCode_itCanBeConvertedToHex() {
		$subscription = new Subscription();
		$subscription->setConfirmationCode( 'Unicorns_Kittens' );
		$this->assertSame( '556e69636f726e735f4b697474656e73', $subscription->getHexConfirmationCode() );
	}

	public function testGivenAHexConfirmationCode_itCanBeConvertedToBinary() {
		$subscription = new Subscription();
		$subscription->setHexConfirmationCode( '417765736f6d655f4d656f7773212121' );
		$this->assertSame( 'Awesome_Meows!!!', $subscription->getConfirmationCode() );
	}
}