<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613130134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE controle_unitaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE controle_unitaire (id INT NOT NULL, pv_emis BOOLEAN NOT NULL, navire_etranger BOOLEAN NOT NULL, enregistrement_navire VARCHAR(32) NOT NULL, commentaire TEXT DEFAULT NULL, brouillon BOOLEAN NOT NULL, type VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_unitaire_categorie_controle_armement (controle_unitaire_id INT NOT NULL, categorie_controle_armement_id INT NOT NULL, PRIMARY KEY(controle_unitaire_id, categorie_controle_armement_id))');
        $this->addSql('CREATE INDEX IDX_E5616451770B6865 ON controle_unitaire_categorie_controle_armement (controle_unitaire_id)');
        $this->addSql('CREATE INDEX IDX_E5616451F0C71 ON controle_unitaire_categorie_controle_armement (categorie_controle_armement_id)');
        $this->addSql('CREATE TABLE controle_unitaire_categorie_controle_personnel (controle_unitaire_id INT NOT NULL, categorie_controle_personnel_id INT NOT NULL, PRIMARY KEY(controle_unitaire_id, categorie_controle_personnel_id))');
        $this->addSql('CREATE INDEX IDX_FD4B5628770B6865 ON controle_unitaire_categorie_controle_personnel (controle_unitaire_id)');
        $this->addSql('CREATE INDEX IDX_FD4B5628CCA4C8BA ON controle_unitaire_categorie_controle_personnel (categorie_controle_personnel_id)');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_armement ADD CONSTRAINT FK_E5616451770B6865 FOREIGN KEY (controle_unitaire_id) REFERENCES controle_unitaire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_armement ADD CONSTRAINT FK_E5616451F0C71 FOREIGN KEY (categorie_controle_armement_id) REFERENCES categorie_controle_armement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_personnel ADD CONSTRAINT FK_FD4B5628770B6865 FOREIGN KEY (controle_unitaire_id) REFERENCES controle_unitaire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_personnel ADD CONSTRAINT FK_FD4B5628CCA4C8BA FOREIGN KEY (categorie_controle_personnel_id) REFERENCES categorie_controle_personnel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE controle_unitaire_id_seq CASCADE');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_armement DROP CONSTRAINT FK_E5616451770B6865');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_armement DROP CONSTRAINT FK_E5616451F0C71');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_personnel DROP CONSTRAINT FK_FD4B5628770B6865');
        $this->addSql('ALTER TABLE controle_unitaire_categorie_controle_personnel DROP CONSTRAINT FK_FD4B5628CCA4C8BA');
        $this->addSql('DROP TABLE controle_unitaire');
        $this->addSql('DROP TABLE controle_unitaire_categorie_controle_armement');
        $this->addSql('DROP TABLE controle_unitaire_categorie_controle_personnel');
    }
}
