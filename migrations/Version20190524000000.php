<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This class alters the Address table
 * It adds the donation_receipt column so that Address is directly storing the opt in preference
 *
 * This script should only be executed in maintenance mode, as the ALTER table queries may take a while to process
 *
 * @package DoctrineMigrations
 */
final class Version20190524000000 extends AbstractMigration
{
	public function up(Schema $schema) : void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

		$this->addSql('ALTER TABLE address ADD donation_receipt TINYINT(1) NOT NULL');
	}

	public function down(Schema $schema) : void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

		$this->addSql('ALTER TABLE address DROP donation_receipt');
	}
}
