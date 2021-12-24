<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221111215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE pam_controle_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_mission_type_id_seq CASCADE');
        $this->addSql('ALTER TABLE pam_rapport ADD start_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD end_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport DROP start_date');
        $this->addSql('ALTER TABLE pam_rapport DROP end_date');
        $this->addSql('ALTER TABLE pam_rapport DROP start_time');
        $this->addSql('ALTER TABLE pam_rapport DROP end_time');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE pam_controle_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_mission_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE pam_rapport ADD start_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD end_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD start_time VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD end_time VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_rapport DROP start_datetime');
        $this->addSql('ALTER TABLE pam_rapport DROP end_datetime');
    }
}
