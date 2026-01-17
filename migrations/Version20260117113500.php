<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20260117113500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add isSuccessful column to monitoring_info table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'ALTER TABLE monitoring_info ADD COLUMN monitoringinfo_successful TINYINT(1) DEFAULT NULL, ALGORITHM=INSTANT'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monitoring_info DROP COLUMN monitoringinfo_sucessful, ALGORITHM=INSTANT');
    }
}
