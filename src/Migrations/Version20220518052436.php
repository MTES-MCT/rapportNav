<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518052436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER INDEX uniq_268b9c9d9b6b5fba RENAME TO UNIQ_268B9C9D3C0C9956');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD date_depart TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD date_arrivee TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER INDEX uniq_268b9c9d3c0c9956 RENAME TO uniq_268b9c9d9b6b5fba');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP date_depart');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP date_arrivee');
    }
}
