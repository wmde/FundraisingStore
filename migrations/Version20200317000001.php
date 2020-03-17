<?php

declare( strict_types = 1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add external id and external id type fields to address change table and copy the existing
 * relations data from memberships and donations to the new columns.
 */
final class Version20200317000001 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

		$this->addSql('ALTER TABLE address_change ADD external_id INT NOT NULL, ADD external_id_type VARCHAR(10) NOT NULL');
		$this->addSql('CREATE INDEX ac_ext_id ON address_change (external_id_type, external_id)');
    }

	public function postUp( Schema $schema ) {
    	$this->connection->exec( 'UPDATE address_change a INNER JOIN spenden d ON d.address_change_id=a.id SET a.external_id_type="donation", a.external_id=d.address_change_id' );
		$this->connection->exec( 'UPDATE address_change a INNER JOIN request r ON r.address_change_id=a.id SET a.external_id_type="membership", a.external_id=r.address_change_id' );
	}

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX ac_ext_id ON address_change');
        $this->addSql('ALTER TABLE address_change DROP external_id, DROP external_id_type');
    }
}
