<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114144646 extends AbstractMigration {
    public function getDescription(): string {
        return 'Add mission conjointe';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE service_interministeriel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rapport_service_interministeriel (rapport_id INT NOT NULL, service_interministeriel_id INT NOT NULL, PRIMARY KEY(rapport_id, service_interministeriel_id))');
        $this->addSql('CREATE INDEX IDX_7F78A7891DFBCC46 ON rapport_service_interministeriel (rapport_id)');
        $this->addSql('CREATE INDEX IDX_7F78A7893767011B ON rapport_service_interministeriel (service_interministeriel_id)');
        $this->addSql('CREATE TABLE service_interministeriel (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE rapport_service_interministeriel ADD CONSTRAINT FK_7F78A7891DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_service_interministeriel ADD CONSTRAINT FK_7F78A7893767011B FOREIGN KEY (service_interministeriel_id) REFERENCES service_interministeriel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport ADD conjointe BOOLEAN NOT NULL DEFAULT FALSE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_service_interministeriel DROP CONSTRAINT FK_7F78A7893767011B');
        $this->addSql('DROP SEQUENCE service_interministeriel_id_seq CASCADE');
        $this->addSql('DROP TABLE rapport_service_interministeriel');
        $this->addSql('DROP TABLE service_interministeriel');
        $this->addSql('ALTER TABLE rapport DROP conjointe');
    }
}
