<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323170838 extends AbstractMigration {
    public function getDescription(): string {
        return 'Remove type_mission_controle (not used anymore). ';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE mission DROP CONSTRAINT fk_9067f23c94a2dfe8');
        $this->addSql('DROP INDEX idx_9067f23c94a2dfe8');
        $this->addSql('DROP SEQUENCE type_mission_controle_id_seq CASCADE');
        $this->addSql('ALTER TABLE mission DROP type_mission_controle_id');
        $this->addSql('DROP TABLE type_mission_controle');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE type_mission_controle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE type_mission_controle (id INT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE mission ADD type_mission_controle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT fk_9067f23c94a2dfe8 FOREIGN KEY (type_mission_controle_id) REFERENCES type_mission_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9067f23c94a2dfe8 ON mission (type_mission_controle_id)');
    }
}
