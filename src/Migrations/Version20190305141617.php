<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305141617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE form_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE submission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE form (id INT NOT NULL, active_version_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, version INT NOT NULL, creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_use TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, data JSONB NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5288FD4F6A1E45F3 ON form (active_version_id)');
        $this->addSql('CREATE INDEX IDX_5288FD4F727ACA70 ON form (parent_id)');
        $this->addSql('CREATE TABLE submission (id INT NOT NULL, related_form_id INT NOT NULL, last_edition TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data JSONB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB055AF360EF51D8 ON submission (related_form_id)');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT FK_5288FD4F6A1E45F3 FOREIGN KEY (active_version_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT FK_5288FD4F727ACA70 FOREIGN KEY (parent_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF360EF51D8 FOREIGN KEY (related_form_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE form DROP CONSTRAINT FK_5288FD4F6A1E45F3');
        $this->addSql('ALTER TABLE form DROP CONSTRAINT FK_5288FD4F727ACA70');
        $this->addSql('ALTER TABLE submission DROP CONSTRAINT FK_DB055AF360EF51D8');
        $this->addSql('DROP SEQUENCE form_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE submission_id_seq CASCADE');
        $this->addSql('DROP TABLE form');
        $this->addSql('DROP TABLE submission');
    }
}
