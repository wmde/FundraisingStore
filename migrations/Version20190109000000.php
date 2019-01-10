<?php declare( strict_types = 1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Driver\PDOStatement;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WMDE\Fundraising\Entities\AddressChange;

/**
 * This class alters the AddressChange table
 * It adds the two columns third_party_identifier and address_type
 * Afterwards, the address_type column is filled with the appropriate value for each row
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
			'ALTER TABLE address_change ADD third_party_identifier INT DEFAULT NULL, ADD address_type VARCHAR(10) NOT NULL'
		);
		$this->addSql( 'CREATE UNIQUE INDEX UNIQ_7B0E7B9F71AFE7AD ON address_change (third_party_identifier)' );
	}

	public function postUp( Schema $schema ) {
		$entityCount = $this->getTotalUpdateRowCount();
		$pageCount = (int)ceil( $entityCount / self::DB_QUERY_PAGE_SIZE );
		echo $entityCount . ' entries to be updated.' . PHP_EOL;
		for ( $page = 0; $page < $pageCount; $page++ ) {
			echo 'Page ' . ( $page + 1 ) . ' / ' . $pageCount . PHP_EOL;
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
				$stmt = $this->connection->prepare( $query );
				$stmt->execute();
				$stmt->closeCursor();
				$this->connection->commit();
				$this->connection->beginTransaction();
			}
		}
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
			)->orderBy( 'address_change.id', 'ASC' )
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
		$this->addSql( 'DROP INDEX UNIQ_7B0E7B9F71AFE7AD ON address_change' );
		$this->addSql( 'ALTER TABLE address_change DROP third_party_identifier, DROP address_type' );
	}
}
