<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260117080438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add monitoring_config and monitoring_info tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE monitoring_config (monitoringconfig_id INT AUTO_INCREMENT NOT NULL, monitoringconfig_url VARCHAR(255) NOT NULL, monitoringconfig_expectedhttpcode SMALLINT DEFAULT NULL, monitoringconfig_requestmethod VARCHAR(10) DEFAULT NULL, monitoringconfig_created DATETIME NOT NULL, PRIMARY KEY (monitoringconfig_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitoring_info (monitoringinfo_id INT AUTO_INCREMENT NOT NULL, monitoringinfo_httpcode SMALLINT NOT NULL, monitoringinfo_monitoringconfig_id INT NOT NULL, monitoringinfo_created DATETIME NOT NULL, PRIMARY KEY (monitoringinfo_id), INDEX idx_monitoringconfig_id (monitoringinfo_monitoringconfig_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE monitoring_config');
        $this->addSql('DROP TABLE monitoring_info');
    }
}
