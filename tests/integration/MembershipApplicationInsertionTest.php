<?php

namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\DoctrineMembershipApplication;

class MembershipApplicationInsertionTest extends \PHPUnit_Framework_TestCase {

	public function testNewMembershipApplicationCanBeInserted() {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( new DoctrineMembershipApplication() );
		$entityManager->flush();
		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( DoctrineMembershipApplication::class, 'r' )
			->getQuery()
			->getSingleScalarResult();
		$this->assertEquals( 1, $count ); // Can't use assertSame because a string is returned
	}
}
