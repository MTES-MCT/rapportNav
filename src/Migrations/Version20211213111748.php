<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211213111748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE pam_check_mission_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_check_mission');
        $this->addSql('ALTER TABLE pam_draft ADD number VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD number VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE pam_check_mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_check_mission (id INT NOT NULL, rapport_id INT NOT NULL, label VARCHAR(255) NOT NULL, checked BOOLEAN DEFAULT NULL, start_date DATE DEFAULT NULL, start_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, end_date DATE DEFAULT NULL, end_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, is_main BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2cd291621dfbcc46 ON pam_check_mission (rapport_id)');
        $this->addSql('ALTER TABLE pam_check_mission ADD CONSTRAINT fk_2cd291621dfbcc46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_draft DROP number');
        $this->addSql('ALTER TABLE pam_rapport DROP number');
    }
}
