<?php


namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Request;

class RequestInsertionTest extends \PHPUnit_Framework_TestCase {

	public function testNewRequestCanBeInserted() {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$entityManager->persist( new Request() );
		$entityManager->flush();
		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( Request::class, 'r' )
			->getQuery()
			->getSingleScalarResult();
		$this->assertSame( 1, $count );
	}
}
