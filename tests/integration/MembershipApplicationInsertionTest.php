<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\MembershipApplication;

class MembershipApplicationInsertionTest extends \PHPUnit_Framework_TestCase {

	public function testNewMembershipApplicationCanBeInserted() {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( new MembershipApplication() );
		$entityManager->flush();
		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( MembershipApplication::class, 'r' )
			->getQuery()
			->getSingleScalarResult();
		$this->assertEquals( 1, $count ); // Can't use assertSame because a string is returned
	}
}
