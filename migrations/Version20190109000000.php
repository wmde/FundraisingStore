<?php declare( strict_types = 1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Statement;
use Doctrine\Migrations\AbstractMigration;
use WMDE\Fundraising\Entities\AddressChange;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190109000000 extends AbstractMigration {
	private const DB_QUERY_PAGE_SIZE = 1000;
	private const DB_TABLE_ADDRESS_CHANGE = 'address_change';

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
			echo 'Page ' . ( $pageCount + 1 ) . ' / ' . $pageCount . PHP_EOL;
			$query = '';
			foreach ( $this->getCurrentPage() as $addressEntry ) {
				$data = $addressEntry['donation_data'] ?? $addressEntry['membership_data'];
				$type = $this->getAddressType( $data );
				$query .= 'UPDATE address_change ( address_type ) VALUES ( "' . $type . '" );';
			}
			if ( $query !== '' ) {
				$stmt = $this->connection->prepare( $query );
				$stmt->execute();
				$stmt->closeCursor();
				$this->connection->commit();
			}
		}
	}

	private function getAddressType( string $data ): string {
		$data = unserialize( base64_decode( $data ) );
		if ( $data['adresstyp'] === 'person' ) {
			return AddressChange::ADDRESS_TYPE_PERSON;
		}
		if ( $data['adresstyp'] === 'firma' ) {
			return AddressChange::ADDRESS_TYPE_COMPANY;
		}
	}

	private function getCurrentPage(): Statement {
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
			->where( 'address_type is NULL' )
			->setMaxResults( self::DB_QUERY_PAGE_SIZE );
		return $query->execute();
	}

	private function getTotalUpdateRowCount(): int {
		$queryBuilder = $this->connection->createQueryBuilder();
		$queryBuilder->select( 'COUNT(id)' )
			->from( self::DB_TABLE_ADDRESS_CHANGE, self::DB_TABLE_ADDRESS_CHANGE )
			->where( 'address_type is NULL' );

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
