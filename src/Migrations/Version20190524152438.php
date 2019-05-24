<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524152438 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pecheur_pied_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_pecheur_pied_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pecheur_pied (id INT NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) DEFAULT NULL, est_pro BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rapport_pecheur_pied (id INT NOT NULL, rapport_id INT NOT NULL, pecheur_pied_id INT NOT NULL, pv BOOLEAN DEFAULT NULL, natinf VARCHAR(45) DEFAULT NULL, commentaire TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A31F41AE1DFBCC46 ON rapport_pecheur_pied (rapport_id)');
        $this->addSql('CREATE INDEX IDX_A31F41AE9823E004 ON rapport_pecheur_pied (pecheur_pied_id)');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ADD CONSTRAINT FK_A31F41AE1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ADD CONSTRAINT FK_A31F41AE9823E004 FOREIGN KEY (pecheur_pied_id) REFERENCES pecheur_pied (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP CONSTRAINT FK_A31F41AE9823E004');
        $this->addSql('DROP SEQUENCE pecheur_pied_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_pecheur_pied_id_seq CASCADE');
        $this->addSql('DROP TABLE pecheur_pied');
        $this->addSql('DROP TABLE rapport_pecheur_pied');
    }
}
