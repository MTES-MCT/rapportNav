<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210085505 extends AbstractMigration {
  public function getDescription(): string {
    return 'Add tables related to Loisir Controls. ';
  }

  public function up(Schema $schema): void {
    // this up() migration is auto-generated, please modify it to your needs
    $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

    $this->addSql('CREATE SEQUENCE loisir_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
    $this->addSql('CREATE SEQUENCE controle_loisir_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
    $this->addSql('CREATE TABLE loisir (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    $this->addSql('CREATE TABLE controle_loisir (id INT NOT NULL, rapport_id INT NOT NULL, loisir_id INT NOT NULL, nombre_controle INT NOT NULL, nombre_pv INT NOT NULL, commentaire TEXT DEFAULT NULL, PRIMARY KEY(id))');
    $this->addSql('CREATE INDEX IDX_821A0BFA1DFBCC46 ON controle_loisir (rapport_id)');
    $this->addSql('CREATE INDEX IDX_821A0BFAA19C359 ON controle_loisir (loisir_id)');
    $this->addSql('CREATE TABLE controle_loisir_natinf (controle_loisir_id INT NOT NULL, natinf_id INT NOT NULL, PRIMARY KEY(controle_loisir_id, natinf_id))');
    $this->addSql('CREATE INDEX IDX_E5605710C0841305 ON controle_loisir_natinf (controle_loisir_id)');
    $this->addSql('CREATE INDEX IDX_E5605710F87A39C6 ON controle_loisir_natinf (natinf_id)');
    $this->addSql('ALTER TABLE controle_loisir ADD CONSTRAINT FK_821A0BFA1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    $this->addSql('ALTER TABLE controle_loisir ADD CONSTRAINT FK_821A0BFAA19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    $this->addSql('ALTER TABLE controle_loisir_natinf ADD CONSTRAINT FK_E5605710C0841305 FOREIGN KEY (controle_loisir_id) REFERENCES controle_loisir (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    $this->addSql('ALTER TABLE controle_loisir_natinf ADD CONSTRAINT FK_E5605710F87A39C6 FOREIGN KEY (natinf_id) REFERENCES natinf (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
  }

  public function down(Schema $schema): void {
    // this down() migration is auto-generated, please modify it to your needs
    $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

    $this->addSql('CREATE SCHEMA public');
    $this->addSql('ALTER TABLE controle_loisir DROP CONSTRAINT FK_821A0BFAA19C359');
    $this->addSql('ALTER TABLE controle_loisir_natinf DROP CONSTRAINT FK_E5605710C0841305');
    $this->addSql('DROP SEQUENCE loisir_id_seq CASCADE');
    $this->addSql('DROP SEQUENCE controle_loisir_id_seq CASCADE');
    $this->addSql('DROP TABLE loisir');
    $this->addSql('DROP TABLE controle_loisir');
    $this->addSql('DROP TABLE controle_loisir_natinf');
  }
}
