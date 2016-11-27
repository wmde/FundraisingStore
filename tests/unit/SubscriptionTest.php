<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Subscription;

/**
 * @covers WMDE\Fundraising\Entities\Subscription
 *
 * @licence GNU GPL v2+
 * @author Gabriel Birke < gabriel.birke@wikimedia.de >
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubscriptionTest extends \PHPUnit_Framework_TestCase {

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

	public function testWhenSubscriptionIsNew_needsModerationReturnsFalse() {
		$subscription = new Subscription();

		$this->assertFalse( $subscription->needsModeration() );
	}

	public function testWhenPendingModeration_needsModerationReturnsTrue() {
		$subscription = new Subscription();
		$subscription->markForModeration();

		$this->assertTrue( $subscription->needsModeration() );
	}

}
