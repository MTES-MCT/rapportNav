<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208083555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_check_mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_draft_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_check_mission (id INT NOT NULL, rapport_id INT NOT NULL, label VARCHAR(255) NOT NULL, checked BOOLEAN DEFAULT NULL, start_date DATE DEFAULT NULL, start_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, end_date DATE DEFAULT NULL, end_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, is_main BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CD291621DFBCC46 ON pam_check_mission (rapport_id)');
        $this->addSql('CREATE TABLE pam_draft (id INT NOT NULL, rapport_id INT DEFAULT NULL, body JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D0C81D01DFBCC46 ON pam_draft (rapport_id)');
        $this->addSql('COMMENT ON COLUMN pam_draft.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_draft.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE pam_check_mission ADD CONSTRAINT FK_2CD291621DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_draft ADD CONSTRAINT FK_9D0C81D01DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_rapport ADD start_date DATE NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD end_date DATE NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD start_time TIME(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD end_time TIME(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE pam_check_mission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_draft_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_check_mission');
        $this->addSql('DROP TABLE pam_draft');
        $this->addSql('ALTER TABLE pam_rapport DROP start_date');
        $this->addSql('ALTER TABLE pam_rapport DROP end_date');
        $this->addSql('ALTER TABLE pam_rapport DROP start_time');
        $this->addSql('ALTER TABLE pam_rapport DROP end_time');
    }
}
