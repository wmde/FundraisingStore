<?php


namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Inquiry;

class RequestInsertionTest extends \PHPUnit_Framework_TestCase {

	public function testNewRequestCanBeInserted() {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( new Inquiry() );
		$entityManager->flush();
		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( Inquiry::class, 'r' )
			->getQuery()
			->getSingleScalarResult();
		$this->assertEquals( 1, $count ); // Can't use assertSame because a string is returned
	}
}
