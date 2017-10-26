<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Store\Tests;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Entities\MembershipApplication;

/**
 * @covers \WMDE\Fundraising\Entities\MembershipApplication
 */
class MembershipApplicationInsertionTest extends TestCase {

	public function testNewMembershipApplicationCanBeInserted(): void {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( new MembershipApplication() );
		$entityManager->flush();

		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( MembershipApplication::class, 'r' )
			->getQuery()
			->getSingleScalarResult();

		$this->assertSame( '1', $count );
	}

}
