<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204171104 extends AbstractMigration {
  public function getDescription(): string {
    return '';
  }

  public function up(Schema $schema): void {
    // this up() migration is auto-generated, please modify it to your needs
    $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

    $this->addSql('ALTER TABLE controle_etablissement DROP CONSTRAINT IF EXISTS fk_93f103ff54eed909');
    $this->addSql('DROP INDEX IF EXISTS idx_93f103ff54eed909');
    $this->addSql('ALTER TABLE controle_etablissement DROP IF EXISTS methode_ciblage_id');
    $this->addSql('ALTER TABLE controle_pecheur_pied DROP CONSTRAINT IF EXISTS fk_6dc9d3c554eed909');
    $this->addSql('DROP INDEX IF EXISTS idx_6dc9d3c554eed909');
    $this->addSql('ALTER TABLE controle_pecheur_pied DROP IF EXISTS methode_ciblage_id');
    $this->addSql('ALTER TABLE draft DROP IF EXISTS rapport_type');
  }

  public function down(Schema $schema): void {
    // this down() migration is auto-generated, please modify it to your needs
    $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

    $this->addSql('CREATE SCHEMA public');
    $this->addSql('ALTER TABLE controle_etablissement ADD methode_ciblage_id INT DEFAULT NULL');
    $this->addSql('ALTER TABLE controle_etablissement ADD CONSTRAINT fk_93f103ff54eed909 FOREIGN KEY (methode_ciblage_id) REFERENCES methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    $this->addSql('CREATE INDEX idx_93f103ff54eed909 ON controle_etablissement (methode_ciblage_id)');
    $this->addSql('ALTER TABLE draft ADD rapport_type VARCHAR(45) NOT NULL');
    $this->addSql('ALTER TABLE controle_pecheur_pied ADD methode_ciblage_id INT DEFAULT NULL');
    $this->addSql('ALTER TABLE controle_pecheur_pied ADD CONSTRAINT fk_6dc9d3c554eed909 FOREIGN KEY (methode_ciblage_id) REFERENCES methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    $this->addSql('CREATE INDEX idx_6dc9d3c554eed909 ON controle_pecheur_pied (methode_ciblage_id)');
  }
}
