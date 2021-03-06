<?php declare( strict_types = 1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Driver\PDOStatement;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WMDE\Fundraising\Entities\AddressChange;

/**
 * This class alters the AddressChange table
 * It adds the address_type column so that AddressChange is directly storing the type of the address (person vs company)
 * Afterwards, the column is filled with the appropriate value for each row
 *
 * This script should only be executed in maintenance mode, as the ALTER table queries may take a while to process
 *
 * @package DoctrineMigrations
 */
final class Version20190109000000 extends AbstractMigration {
	private const DB_QUERY_PAGE_SIZE = 5000;
	private const DB_TABLE_ADDRESS_CHANGE = 'address_change';
	private const DB_TABLE_DONATIONS = 'spenden';
	private const DB_TABLE_MEMBERSHIP_APPLICATIONS = 'request';

	public function up( Schema $schema ): void {
		$this->abortIf(
			$this->connection->getDatabasePlatform()->getName() !== 'mysql',
			'Migration can only be executed safely on \'mysql\'.'
		);
		$this->addSql(
			'ALTER TABLE address_change ADD address_type VARCHAR(10) NOT NULL, ' .
			'ADD export_date DATETIME, ' .
			'ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
			'ADD modified_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP'
		);
		$this->addSql( 'CREATE INDEX ac_export_date ON address_change (export_date)' );
	}

	public function postUp( Schema $schema ) {
		$entityCount = $this->getTotalUpdateRowCount();
		$pageCount = (int)ceil( $entityCount / self::DB_QUERY_PAGE_SIZE );
		$this->write( $entityCount . ' entries to be updated.' );
		// As the migration progresses, this low-cardinality temporary index speeds up getCurrentPage query
		$this->connection->exec( 'CREATE INDEX tmp_address_change ON address_change (address_type)' );
		$this->connection->setAutoCommit( false );
		$this->connection->connect(); // with autoCommit set to false, this implicitly begins a new Transaction. beginTransaction leads to wonky behavior
		for ( $page = 0; $page < $pageCount; $page++ ) {
			$startTime = microtime( true );
			$query = '';
			foreach ( $this->getCurrentPage() as $addressEntry ) {
				$data = $addressEntry['donation_data'] ?? $addressEntry['membership_data'];
				if ( $data === null ) {
					// Entries with no data are deleted from the AddressChange table and the foreign key reference is removed
					$query .= $this->getAddressChangeDeleteQueries( (int) $addressEntry['id'] );
					continue;
				}
				$type = $this->getAddressType( $data );
				$query .= 'UPDATE address_change SET address_type = "' . $type . '" WHERE id = "' . $addressEntry['id'] . '";';
			}
			if ( $query !== '' ) {
				$this->connection->exec( $query );
				$this->connection->commit();
				$this->write( sprintf( 'Updated page %d / %d - %.2f seconds', $page + 1, $pageCount, microtime( true ) - $startTime ) );
			}
		}
		$this->connection->exec( 'DROP INDEX tmp_address_change ON address_change' );
	}

	private function getAddressType( string $data ): string {
		if ( isset( $data['adresstyp'] ) && $data['adresstyp'] === 'firma'
			|| ( isset( $data['firma'] ) && $data['firma'] !== '' ) ) {
			return AddressChange::ADDRESS_TYPE_COMPANY;
		}
		return AddressChange::ADDRESS_TYPE_PERSON;
	}

	private function getAddressChangeDeleteQueries( int $id ): string {
		$query = 'UPDATE ' . self::DB_TABLE_DONATIONS . ' SET address_change_id = NULL WHERE address_change_id = ' . $id . ';';
		$query .= 'UPDATE ' . self::DB_TABLE_MEMBERSHIP_APPLICATIONS . ' SET address_change_id = NULL WHERE address_change_id = ' . $id . ';';
		$query .= 'DELETE FROM ' . self::DB_TABLE_ADDRESS_CHANGE . ' WHERE id = ' . $id . ';';
		return $query;
	}

	private function getCurrentPage(): PDOStatement {
		$queryBuilder = $this->connection->createQueryBuilder();
		$query = $queryBuilder->select( 'address_change.id, s.data as donation_data, r.data as membership_data' )
			->from( 'address_change' )
			->leftJoin(
				'address_change',
				'spenden',
				's',
				's.address_change_id = address_change.id'
			)->leftJoin(
				'address_change',
				'request',
				'r',
				'r.address_change_id = address_change.id'
			)
			->where( 'address_type = ""' )
			->setMaxResults( self::DB_QUERY_PAGE_SIZE );
		return $query->execute();
	}

	private function getTotalUpdateRowCount(): int {
		$queryBuilder = $this->connection->createQueryBuilder();
		$queryBuilder->select( 'COUNT(id)' )
			->from( self::DB_TABLE_ADDRESS_CHANGE, self::DB_TABLE_ADDRESS_CHANGE )
			->where( 'address_type = ""' );

		return (int)$queryBuilder->execute()->fetchColumn( 0 );
	}

	public function down( Schema $schema ): void {
		$this->abortIf(
			$this->connection->getDatabasePlatform()->getName() !== 'mysql',
			'Migration can only be executed safely on \'mysql\'.'
		);
		$this->addSql( 'DROP INDEX ac_export_date ON address_change' );
		$this->addSql( 'ALTER TABLE address_change DROP address_type, DROP export_date, DROP created_at, DROP modified_at' );
	}
}
