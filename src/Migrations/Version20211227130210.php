<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227130210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT fk_2c2ce903c54c8c93');
        $this->addSql('ALTER TABLE pam_mission DROP CONSTRAINT fk_87a1268ac54c8c93');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT fk_2ae6df0cc54c8c93');
        $this->addSql('CREATE TABLE category_pam_controle (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category_pam_indicateur (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category_pam_mission (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE pam_controle_type');
        $this->addSql('DROP TABLE pam_mission_type');
        $this->addSql('DROP TABLE pam_indicateur_type');
        $this->addSql('DROP INDEX idx_2c2ce903c54c8c93');
        $this->addSql('ALTER TABLE pam_controle RENAME COLUMN type_id TO category_id');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT FK_2C2CE90312469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2C2CE90312469DE2 ON pam_controle (category_id)');
        $this->addSql('DROP INDEX idx_2ae6df0cc54c8c93');
        $this->addSql('ALTER TABLE pam_indicateur RENAME COLUMN type_id TO category_id');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0C12469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_indicateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2AE6DF0C12469DE2 ON pam_indicateur (category_id)');
        $this->addSql('DROP INDEX idx_87a1268ac54c8c93');
        $this->addSql('ALTER TABLE pam_mission RENAME COLUMN type_id TO category_id');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT FK_87A1268A12469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_87A1268A12469DE2 ON pam_mission (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT FK_2C2CE90312469DE2');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0C12469DE2');
        $this->addSql('ALTER TABLE pam_mission DROP CONSTRAINT FK_87A1268A12469DE2');
        $this->addSql('CREATE TABLE pam_controle_type (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_mission_type (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_indicateur_type (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE category_pam_controle');
        $this->addSql('DROP TABLE category_pam_indicateur');
        $this->addSql('DROP TABLE category_pam_mission');
        $this->addSql('DROP INDEX IDX_2C2CE90312469DE2');
        $this->addSql('ALTER TABLE pam_controle RENAME COLUMN category_id TO type_id');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT fk_2c2ce903c54c8c93 FOREIGN KEY (type_id) REFERENCES pam_controle_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2c2ce903c54c8c93 ON pam_controle (type_id)');
        $this->addSql('DROP INDEX IDX_2AE6DF0C12469DE2');
        $this->addSql('ALTER TABLE pam_indicateur RENAME COLUMN category_id TO type_id');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT fk_2ae6df0cc54c8c93 FOREIGN KEY (type_id) REFERENCES pam_indicateur_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2ae6df0cc54c8c93 ON pam_indicateur (type_id)');
        $this->addSql('DROP INDEX IDX_87A1268A12469DE2');
        $this->addSql('ALTER TABLE pam_mission RENAME COLUMN category_id TO type_id');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT fk_87a1268ac54c8c93 FOREIGN KEY (type_id) REFERENCES pam_mission_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_87a1268ac54c8c93 ON pam_mission (type_id)');
    }
}
