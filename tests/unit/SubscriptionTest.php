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

	public function testSetAndGetSource() {
		$subscription = new Subscription();
		$subscription->setSource( 'foobar' );
		$this->assertSame( 'foobar', $subscription->getSource() );
	}

	public function testWhenSubscriptionIsNew_isUnconfirmedReturnsTrue() {
		$this->assertTrue( ( new Subscription() )->isUnconfirmed() );
	}

	public function testWhenConfirmed_isUnconfirmedReturnsFalse() {
		$subscription = new Subscription();
		$subscription->markAsConfirmed();

		$this->assertFalse( $subscription->isUnconfirmed() );
	}

	public function testWhenPendingModeration_isUnconfirmedReturnsTrue() {
		$subscription = new Subscription();
		$subscription->markForModeration();

		$this->assertTrue( $subscription->isUnconfirmed() );
	}

}
