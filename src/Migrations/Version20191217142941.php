<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217142941 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categorie_controle_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_sans_pv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie_controle_navire (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE mission DROP aire_marine');
        $this->addSql('ALTER TABLE navire DROP erreur_texte');
        $this->addSql('ALTER TABLE navire DROP is_erreur');
        $this->addSql('ALTER TABLE navire ALTER type_usage DROP NOT NULL');
        $this->addSql('ALTER TABLE navire ADD categorie_controle_navire_id INT');
        $this->addSql('ALTER TABLE navire ADD pavillon TEXT NOT NULL DEFAULT \'Français\'');
        $this->addSql('ALTER TABLE navire ADD etranger BOOLEAN NOT NULL DEFAULT false');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038DF83C9D5 FOREIGN KEY (categorie_controle_navire_id) REFERENCES categorie_controle_navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EED1038DF83C9D5 ON navire (categorie_controle_navire_id)');
        $this->addSql('ALTER TABLE navire ALTER pavillon DROP DEFAULT');
        $this->addSql('ALTER TABLE navire ALTER etranger DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire DROP CONSTRAINT FK_EED1038DF83C9D5');
        $this->addSql('DROP SEQUENCE categorie_controle_navire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_sans_pv_id_seq CASCADE');
        $this->addSql('DROP TABLE categorie_controle_navire');
        $this->addSql('DROP INDEX IDX_EED1038DF83C9D5');
        $this->addSql('ALTER TABLE navire DROP categorie_controle_navire_id');
        $this->addSql('ALTER TABLE navire DROP pavillon');
        $this->addSql('ALTER TABLE navire DROP etranger');
        $this->addSql('ALTER TABLE navire ADD is_erreur BOOLEAN NOT NULL DEFAULT false');
        $this->addSql('ALTER TABLE navire ADD erreur_texte TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD aire_marine VARCHAR(255) DEFAULT NULL');
        $this->addSql('UPDATE navire SET type_usage= \'Inconnu\' WHERE type_usage IS NULL');
        $this->addSql('ALTER TABLE navire ALTER type_usage SET NOT NULL');
    }
}
