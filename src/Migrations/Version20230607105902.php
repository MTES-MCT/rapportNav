<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607105902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE categorie_controle_armement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_controle_personnel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_lot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie_controle_armement (id INT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE categorie_controle_personnel (id INT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_lot (id INT NOT NULL, nombre INT NOT NULL, pv_emis BOOLEAN NOT NULL, commentaire TEXT DEFAULT NULL, brouillon BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_lot_categorie_controle_armement (controle_lot_id INT NOT NULL, categorie_controle_armement_id INT NOT NULL, PRIMARY KEY(controle_lot_id, categorie_controle_armement_id))');
        $this->addSql('CREATE INDEX IDX_B3665B01E5EA8E6D ON controle_lot_categorie_controle_armement (controle_lot_id)');
        $this->addSql('CREATE INDEX IDX_B3665B01F0C71 ON controle_lot_categorie_controle_armement (categorie_controle_armement_id)');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_armement ADD CONSTRAINT FK_B3665B01E5EA8E6D FOREIGN KEY (controle_lot_id) REFERENCES controle_lot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_armement ADD CONSTRAINT FK_B3665B01F0C71 FOREIGN KEY (categorie_controle_armement_id) REFERENCES categorie_controle_armement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fonction_agent DROP deleted_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE categorie_controle_armement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_controle_personnel_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_lot_id_seq CASCADE');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_armement DROP CONSTRAINT FK_B3665B01E5EA8E6D');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_armement DROP CONSTRAINT FK_B3665B01F0C71');
        $this->addSql('DROP TABLE categorie_controle_armement');
        $this->addSql('DROP TABLE categorie_controle_personnel');
        $this->addSql('DROP TABLE controle_lot');
        $this->addSql('DROP TABLE controle_lot_categorie_controle_armement');
        $this->addSql('ALTER TABLE fonction_agent ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN fonction_agent.deleted_at IS \'(DC2Type:datetime_immutable)\'');
    }
}
