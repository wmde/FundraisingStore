<?php


namespace WMDE\Fundraising\Store\Tests;

use WMDE\Fundraising\Entities\Request;

class RequestInsertionTest extends \PHPUnit_Framework_TestCase {

	public function testNewRequestCanBeInserted() {
		$entityManager = TestEnvironment::newDefault()->getFactory()->getEntityManager();
		$request = new Request();
		$entityManager->persist( $request );
		$entityManager->flush();
		$count = $entityManager->createQueryBuilder()
			->select( 'COUNT(r.id)' )
			->from( Request::class, 'r')
			->getQuery()
			->getSingleScalarResult();
		$this->assertEquals( 1, $count );
	}
}
