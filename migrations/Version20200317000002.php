<?php

declare( strict_types = 1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Drop relations Donations->AddressChange and Memberships->AddressChange.
 * The relationship was inverted in the previous migration.
 */
final class Version20200317000002 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
		$this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FBB7DB7BC');
		$this->addSql('DROP INDEX UNIQ_3B978F9FBB7DB7BC ON request');
		$this->addSql('ALTER TABLE request DROP address_change_id');
		$this->addSql('ALTER TABLE spenden DROP FOREIGN KEY FK_3CBBD045BB7DB7BC');
		$this->addSql('DROP INDEX UNIQ_3CBBD045BB7DB7BC ON spenden');
		$this->addSql('ALTER TABLE spenden DROP address_change_id');

    }

    public function down(Schema $schema) : void
    {
		$this->addSql('ALTER TABLE request ADD address_change_id INT DEFAULT NULL');
		$this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FBB7DB7BC FOREIGN KEY (address_change_id) REFERENCES address_change (id)');
		$this->addSql('CREATE UNIQUE INDEX UNIQ_3B978F9FBB7DB7BC ON request (address_change_id)');
		$this->addSql('ALTER TABLE spenden ADD address_change_id INT DEFAULT NULL');
		$this->addSql('ALTER TABLE spenden ADD CONSTRAINT FK_3CBBD045BB7DB7BC FOREIGN KEY (address_change_id) REFERENCES address_change (id)');
		$this->addSql('CREATE UNIQUE INDEX UNIQ_3CBBD045BB7DB7BC ON spenden (address_change_id)');
    }

	public function postDown( Schema $schema ) {
		$this->connection->exec( 'UPDATE spenden d INNER JOIN address_change a ON a.external_id=d.id AND a.external_id_type="donation" SET d.address_change_id=a.id' );
		$this->connection->exec( 'UPDATE request r INNER JOIN address_change a ON a.external_id=r.id AND a.external_id_type="membership" SET r.address_change_id=a.id' );
	}

}
