<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207165723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_indicateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_indicateur_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_indicateur (id INT NOT NULL, mission_id INT NOT NULL, category_id INT NOT NULL, principale INT DEFAULT NULL, secondaire INT DEFAULT NULL, total INT DEFAULT NULL, observations VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AE6DF0CBE6CAE90 ON pam_indicateur (mission_id)');
        $this->addSql('CREATE INDEX IDX_2AE6DF0C12469DE2 ON pam_indicateur (category_id)');
        $this->addSql('CREATE TABLE pam_indicateur_category (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_mission (id INT NOT NULL, rapport_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_87A1268A1DFBCC46 ON pam_mission (rapport_id)');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0CBE6CAE90 FOREIGN KEY (mission_id) REFERENCES pam_mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0C12469DE2 FOREIGN KEY (category_id) REFERENCES pam_indicateur_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT FK_87A1268A1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0C12469DE2');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0CBE6CAE90');
        $this->addSql('DROP SEQUENCE pam_indicateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_indicateur_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_mission_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_indicateur');
        $this->addSql('DROP TABLE pam_indicateur_category');
        $this->addSql('DROP TABLE pam_mission');
    }
}
