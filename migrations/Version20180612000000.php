<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Driver\Statement;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;

/**
 * This class adds the AddressChange table
 * and adds a foreign key relationship to the donation and membership application tables
 *
 * This script should only be executed in maintenance mode, as the ALTER table queries may take a while to process
 *
 * @package DoctrineMigrations
 */
class Version20180612000000 extends AbstractMigration {

	private const DB_QUERY_PAGE_SIZE = 1000;
	private const DB_TABLE_DONATIONS = 'spenden';
	private const DB_TABLE_MEMBERSHIP_APPLICATIONS = 'request';

	/**
	 * @param Schema $schema
	 *
	 * @throws \Exception
	 */
	public function up( Schema $schema ): void {
		$this->abortIf(
			$this->connection->getDatabasePlatform()->getName() !== 'mysql',
			'Migration can only be executed safely on \'mysql\'.'
		);
		$this->skipIf( $schema->hasTable( 'address_change' ), 'AddressChange table already exists' );

		$this->addSql( 'CREATE TABLE address_change (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, current_identifier VARCHAR(36) DEFAULT NULL, previous_identifier VARCHAR(36) DEFAULT NULL, UNIQUE INDEX UNIQ_7B0E7B9FA8954A18 (current_identifier), UNIQUE INDEX UNIQ_7B0E7B9F2EC1D3 (previous_identifier), INDEX IDX_7B0E7B9FF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB' );
		$this->addSql( 'ALTER TABLE address_change ADD CONSTRAINT FK_7B0E7B9FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)' );
		$this->addSql( 'ALTER TABLE spenden ADD address_change_id INT DEFAULT NULL' );
		$this->addSql( 'ALTER TABLE spenden ADD CONSTRAINT FK_3CBBD045BB7DB7BC FOREIGN KEY (address_change_id) REFERENCES address_change (id)' );
		$this->addSql( 'CREATE UNIQUE INDEX UNIQ_3CBBD045BB7DB7BC ON spenden (address_change_id)' );
		$this->addSql( 'ALTER TABLE request ADD address_change_id INT DEFAULT NULL' );
		$this->addSql( 'ALTER TABLE request ADD CONSTRAINT FK_3B978F9FBB7DB7BC FOREIGN KEY (address_change_id) REFERENCES address_change (id)' );
		$this->addSql( 'CREATE UNIQUE INDEX UNIQ_3B978F9FBB7DB7BC ON request (address_change_id)' );
	}

	/**
	 * @param Schema $schema
	 *
	 * @throws \Doctrine\DBAL\DBALException
	 */
	public function postUp( Schema $schema ) {
		$this->updateAddressChangeForeignKeys( self::DB_TABLE_DONATIONS );
		$this->updateAddressChangeForeignKeys( self::DB_TABLE_MEMBERSHIP_APPLICATIONS );
	}

	/**
	 * @param $table
	 *
	 * @throws \Doctrine\DBAL\DBALException
	 */
	private function updateAddressChangeForeignKeys( $table ): void {
		$entityCount = $this->getAddressChangeNullColumnCount( $table );
		$pageCount = (int) ceil( $entityCount / self::DB_QUERY_PAGE_SIZE );
		$currentAddressChangeId = $this->getHighestAddressChangeId();
		$this->connection->beginTransaction();
		$query = '';

		for ( $currentEntity = 0; $currentEntity < $entityCount; $currentEntity++ ) {
			$query .= 'INSERT INTO address_change ( current_identifier ) VALUES ( "' . Uuid::uuid4()->toString() . '" );';
			if ( $currentEntity % self::DB_QUERY_PAGE_SIZE === 0 || $entityCount - 1 === $currentEntity ) {
				$stmt = $this->connection->prepare( $query );
				$stmt->execute();
				$stmt->closeCursor();
				$this->connection->commit();

				if ( $entityCount - 1 !== $currentEntity ) {
					$this->connection->beginTransaction();
				}
				$this->write( $currentEntity . " / $entityCount\n" );
				$query = '';
			}
		}

		for ( $page = 0; $page < $pageCount; $page++ ) {
			$entities = $this->getPageForTable( $table );
			$this->write( 'Page: ' . $page . ' / ' . $pageCount . "\n" );
			foreach ( $entities as $entity ) {
				$currentAddressChangeId++;
				$this->write(
					'UPDATE ' . $table . ' SET address_change_id = ' . $currentAddressChangeId . ' WHERE id = ' . (int)$entity['id'] . "\n"
				);
				$this->connection->executeUpdate(
					'UPDATE ' . $table . ' SET address_change_id = ? WHERE id = ?',
					[ $currentAddressChangeId, (int)$entity['id'] ]
				);
			}
		}
	}

	private function getAddressChangeNullColumnCount( $table ): int {
		$queryBuilder = $this->connection->createQueryBuilder();
		$queryBuilder->select( 'COUNT(id)' )
			->from( $table, $table )
			->where( 'address_change_id is NULL' );

		return $queryBuilder->execute()->fetchColumn( 0 );
	}

	private function getPageForTable( string $table ): Statement {
		$queryBuilder = $this->connection->createQueryBuilder();
		$queryBuilder->select( 'id' )
			->from( $table )
			->where( 'address_change_id is NULL' )
			->orderBy( 'id', 'ASC' )
			->setMaxResults( self::DB_QUERY_PAGE_SIZE );
		return $queryBuilder->execute();
	}

	private function getHighestAddressChangeId(): int {
		$dbResult = $this->connection->createQueryBuilder()
			->select( 'id' )
			->from( 'address_change' )
			->orderBy( 'id', 'DESC' )
			->setMaxResults( 1 )
			->execute()->fetchColumn( 0 );
		return (int)$dbResult;
	}

	/**
	 * @param Schema $schema
	 *
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
	 */
	public function down( Schema $schema ): void {
		$this->abortIf(
			$this->connection->getDatabasePlatform()->getName() !== 'mysql',
			'Migration can only be executed safely on \'mysql\'.'
		);

		$this->addSql( 'ALTER TABLE spenden DROP FOREIGN KEY FK_3CBBD045BB7DB7BC' );
		$this->addSql( 'ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FBB7DB7BC' );
		$this->addSql( 'DROP TABLE address_change' );
		$this->addSql( 'DROP INDEX UNIQ_3B978F9FBB7DB7BC ON request' );
		$this->addSql( 'ALTER TABLE request DROP address_change_id' );
		$this->addSql( 'DROP INDEX UNIQ_3CBBD045BB7DB7BC ON spenden' );
		$this->addSql( 'ALTER TABLE spenden DROP address_change_id' );
	}
}