<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207171336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT fk_2ae6df0c12469de2');
        $this->addSql('DROP SEQUENCE pam_indicateur_category_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE pam_indicateur_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_indicateur_type (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE pam_indicateur_category');
        $this->addSql('DROP INDEX idx_2ae6df0c12469de2');
        $this->addSql('ALTER TABLE pam_indicateur RENAME COLUMN category_id TO type_id');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0CC54C8C93 FOREIGN KEY (type_id) REFERENCES pam_indicateur_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2AE6DF0CC54C8C93 ON pam_indicateur (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0CC54C8C93');
        $this->addSql('DROP SEQUENCE pam_indicateur_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE pam_indicateur_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_indicateur_category (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE pam_indicateur_type');
        $this->addSql('DROP INDEX IDX_2AE6DF0CC54C8C93');
        $this->addSql('ALTER TABLE pam_indicateur RENAME COLUMN type_id TO category_id');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT fk_2ae6df0c12469de2 FOREIGN KEY (category_id) REFERENCES pam_indicateur_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2ae6df0c12469de2 ON pam_indicateur (category_id)');
    }
}
