<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260116213306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds the base for the MonitoringEntry entity.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE monitoring_entry (monitoringentry_id INT AUTO_INCREMENT NOT NULL, monitoringentry_httpcode SMALLINT NOT NULL, monitoringentry_url VARCHAR(255) NOT NULL, monitoringentry_created DATETIME NOT NULL, PRIMARY KEY (monitoringentry_id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE monitoring_entry');
    }
}
