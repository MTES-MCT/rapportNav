<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207155116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_controle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_controle_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_equipage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_membre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_rapport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_controle (id INT NOT NULL, rapport_id INT NOT NULL, type_id INT NOT NULL, pavillon VARCHAR(8) NOT NULL, nb_navire_controle INT NOT NULL, nb_pv_peche_sanitaire INT NOT NULL, nb_equipement_securite INT DEFAULT NULL, nb_pv_titre_nav INT DEFAULT NULL, nb_pv_police INT DEFAULT NULL, nb_pv_env_pollution INT DEFAULT NULL, nb_autre_pv INT DEFAULT NULL, nb_nav_deroute INT DEFAULT NULL, nb_nav_interroge INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2C2CE9031DFBCC46 ON pam_controle (rapport_id)');
        $this->addSql('CREATE INDEX IDX_2C2CE903C54C8C93 ON pam_controle (type_id)');
        $this->addSql('CREATE TABLE pam_controle_type (id INT NOT NULL, label VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_equipage (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pam_equipage.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_equipage.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pam_equipage_pam_membre (pam_equipage_id INT NOT NULL, pam_membre_id INT NOT NULL, PRIMARY KEY(pam_equipage_id, pam_membre_id))');
        $this->addSql('CREATE INDEX IDX_1FAC574B1BDF9D05 ON pam_equipage_pam_membre (pam_equipage_id)');
        $this->addSql('CREATE INDEX IDX_1FAC574B59B8FF7F ON pam_equipage_pam_membre (pam_membre_id)');
        $this->addSql('CREATE TABLE pam_membre (id INT NOT NULL, nom VARCHAR(255) NOT NULL, role VARCHAR(124) NOT NULL, observations VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_rapport (id INT NOT NULL, equipage_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nb_jours_mer INT NOT NULL, nav_eff INT DEFAULT NULL, mouillage INT DEFAULT NULL, maintenance INT DEFAULT NULL, meteo INT DEFAULT NULL, representation INT DEFAULT NULL, administratif INT DEFAULT NULL, autre DOUBLE PRECISION DEFAULT NULL, contr_port INT DEFAULT NULL, technique INT NOT NULL, distance DOUBLE PRECISION DEFAULT NULL, go_marine DOUBLE PRECISION DEFAULT NULL, essence DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9F2742AB735E4A0 ON pam_rapport (equipage_id)');
        $this->addSql('COMMENT ON COLUMN pam_rapport.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_rapport.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT FK_2C2CE9031DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT FK_2C2CE903C54C8C93 FOREIGN KEY (type_id) REFERENCES pam_controle_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre ADD CONSTRAINT FK_1FAC574B1BDF9D05 FOREIGN KEY (pam_equipage_id) REFERENCES pam_equipage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre ADD CONSTRAINT FK_1FAC574B59B8FF7F FOREIGN KEY (pam_membre_id) REFERENCES pam_membre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_rapport ADD CONSTRAINT FK_A9F2742AB735E4A0 FOREIGN KEY (equipage_id) REFERENCES pam_equipage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT FK_2C2CE903C54C8C93');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre DROP CONSTRAINT FK_1FAC574B1BDF9D05');
        $this->addSql('ALTER TABLE pam_rapport DROP CONSTRAINT FK_A9F2742AB735E4A0');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre DROP CONSTRAINT FK_1FAC574B59B8FF7F');
        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT FK_2C2CE9031DFBCC46');
        $this->addSql('DROP SEQUENCE pam_controle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_controle_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_equipage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_membre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_rapport_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_controle');
        $this->addSql('DROP TABLE pam_controle_type');
        $this->addSql('DROP TABLE pam_equipage');
        $this->addSql('DROP TABLE pam_equipage_pam_membre');
        $this->addSql('DROP TABLE pam_membre');
        $this->addSql('DROP TABLE pam_rapport');
    }
}
