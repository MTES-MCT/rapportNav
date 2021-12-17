<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207165956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_mission_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_mission_type (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pam_mission ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT FK_87A1268AC54C8C93 FOREIGN KEY (type_id) REFERENCES pam_mission_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_87A1268AC54C8C93 ON pam_mission (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_mission DROP CONSTRAINT FK_87A1268AC54C8C93');
        $this->addSql('DROP SEQUENCE pam_mission_type_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_mission_type');
        $this->addSql('DROP INDEX IDX_87A1268AC54C8C93');
        $this->addSql('ALTER TABLE pam_mission DROP type_id');
    }
}
