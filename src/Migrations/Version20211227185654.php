<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227185654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_controle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_draft_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_equipage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_equipage_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_indicateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category_pam_controle (id INT NOT NULL, nom VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category_pam_indicateur (id INT NOT NULL, nom VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category_pam_mission (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_agent (id INT NOT NULL, prenom VARCHAR(64) NOT NULL, nom VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_controle (id INT NOT NULL, rapport_id VARCHAR(255) NOT NULL, category_id INT NOT NULL, pavillon VARCHAR(8) NOT NULL, nb_navire_controle INT DEFAULT NULL, nb_pv_peche_sanitaire INT DEFAULT NULL, nb_equipement_securite INT DEFAULT NULL, nb_pv_titre_nav INT DEFAULT NULL, nb_pv_police INT DEFAULT NULL, nb_pv_env_pollution INT DEFAULT NULL, nb_autre_pv INT DEFAULT NULL, nb_nav_deroute INT DEFAULT NULL, nb_nav_interroge INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2C2CE9031DFBCC46 ON pam_controle (rapport_id)');
        $this->addSql('CREATE INDEX IDX_2C2CE90312469DE2 ON pam_controle (category_id)');
        $this->addSql('CREATE TABLE pam_draft (id INT NOT NULL, created_by_id INT NOT NULL, body TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, number VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D0C81D0B03A8386 ON pam_draft (created_by_id)');
        $this->addSql('COMMENT ON COLUMN pam_draft.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_draft.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pam_equipage (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pam_equipage.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_equipage.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pam_equipage_agent (id INT NOT NULL, equipage_id INT NOT NULL, agent_id INT NOT NULL, role VARCHAR(64) NOT NULL, observations VARCHAR(255) DEFAULT NULL, is_absent BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EBC63E18B735E4A0 ON pam_equipage_agent (equipage_id)');
        $this->addSql('CREATE INDEX IDX_EBC63E183414710B ON pam_equipage_agent (agent_id)');
        $this->addSql('CREATE TABLE pam_indicateur (id INT NOT NULL, mission_id INT NOT NULL, category_id INT NOT NULL, principale INT DEFAULT NULL, secondaire INT DEFAULT NULL, total INT DEFAULT NULL, observations VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AE6DF0CBE6CAE90 ON pam_indicateur (mission_id)');
        $this->addSql('CREATE INDEX IDX_2AE6DF0C12469DE2 ON pam_indicateur (category_id)');
        $this->addSql('CREATE TABLE pam_mission (id INT NOT NULL, rapport_id VARCHAR(255) NOT NULL, category_id INT NOT NULL, checked BOOLEAN NOT NULL, is_main BOOLEAN NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_87A1268A1DFBCC46 ON pam_mission (rapport_id)');
        $this->addSql('CREATE INDEX IDX_87A1268A12469DE2 ON pam_mission (category_id)');
        $this->addSql('CREATE TABLE pam_rapport (id VARCHAR(255) NOT NULL, equipage_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nb_jours_mer INT NOT NULL, nav_eff INT DEFAULT NULL, mouillage INT DEFAULT NULL, maintenance INT DEFAULT NULL, meteo INT DEFAULT NULL, representation INT DEFAULT NULL, administratif INT DEFAULT NULL, autre DOUBLE PRECISION DEFAULT NULL, contr_port INT DEFAULT NULL, technique INT NOT NULL, distance DOUBLE PRECISION DEFAULT NULL, go_marine DOUBLE PRECISION DEFAULT NULL, essence DOUBLE PRECISION DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, personnel DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9F2742AB735E4A0 ON pam_rapport (equipage_id)');
        $this->addSql('COMMENT ON COLUMN pam_rapport.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pam_rapport.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT FK_2C2CE9031DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_controle ADD CONSTRAINT FK_2C2CE90312469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_draft ADD CONSTRAINT FK_9D0C81D0B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E18B735E4A0 FOREIGN KEY (equipage_id) REFERENCES pam_equipage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E183414710B FOREIGN KEY (agent_id) REFERENCES pam_agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0CBE6CAE90 FOREIGN KEY (mission_id) REFERENCES pam_mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_indicateur ADD CONSTRAINT FK_2AE6DF0C12469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_indicateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT FK_87A1268A1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_mission ADD CONSTRAINT FK_87A1268A12469DE2 FOREIGN KEY (category_id) REFERENCES category_pam_mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_rapport ADD CONSTRAINT FK_A9F2742AB735E4A0 FOREIGN KEY (equipage_id) REFERENCES pam_equipage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT FK_2C2CE90312469DE2');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0C12469DE2');
        $this->addSql('ALTER TABLE pam_mission DROP CONSTRAINT FK_87A1268A12469DE2');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT FK_EBC63E183414710B');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT FK_EBC63E18B735E4A0');
        $this->addSql('ALTER TABLE pam_rapport DROP CONSTRAINT FK_A9F2742AB735E4A0');
        $this->addSql('ALTER TABLE pam_indicateur DROP CONSTRAINT FK_2AE6DF0CBE6CAE90');
        $this->addSql('ALTER TABLE pam_controle DROP CONSTRAINT FK_2C2CE9031DFBCC46');
        $this->addSql('ALTER TABLE pam_mission DROP CONSTRAINT FK_87A1268A1DFBCC46');
        $this->addSql('DROP SEQUENCE pam_agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_controle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_draft_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_equipage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_equipage_agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_indicateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_mission_id_seq CASCADE');
        $this->addSql('DROP TABLE category_pam_controle');
        $this->addSql('DROP TABLE category_pam_indicateur');
        $this->addSql('DROP TABLE category_pam_mission');
        $this->addSql('DROP TABLE pam_agent');
        $this->addSql('DROP TABLE pam_controle');
        $this->addSql('DROP TABLE pam_draft');
        $this->addSql('DROP TABLE pam_equipage');
        $this->addSql('DROP TABLE pam_equipage_agent');
        $this->addSql('DROP TABLE pam_indicateur');
        $this->addSql('DROP TABLE pam_mission');
        $this->addSql('DROP TABLE pam_rapport');
    }
}
