<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408094924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE form DROP CONSTRAINT fk_5288fd4f6a1e45f3');
        $this->addSql('ALTER TABLE form DROP CONSTRAINT fk_5288fd4f727aca70');
        $this->addSql('ALTER TABLE submission DROP CONSTRAINT fk_db055af360ef51d8');
        $this->addSql('DROP SEQUENCE submission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE form_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE moyen_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_peche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE moyen (id INT NOT NULL, possesseur VARCHAR(45) NOT NULL, nom VARCHAR(100) NOT NULL, type INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE agent (id INT NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, matricule VARCHAR(12) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_peche (id INT NOT NULL, date_mission DATE NOT NULL, type_controle SMALLINT NOT NULL, lieu_mission SMALLINT NOT NULL, zone_mission VARCHAR(100) NOT NULL, duree_mission VARCHAR(255) NOT NULL, commentaire TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_peche_agent (controle_peche_id INT NOT NULL, agent_id INT NOT NULL, PRIMARY KEY(controle_peche_id, agent_id))');
        $this->addSql('CREATE INDEX IDX_90A992B58534A121 ON controle_peche_agent (controle_peche_id)');
        $this->addSql('CREATE INDEX IDX_90A992B53414710B ON controle_peche_agent (agent_id)');
        $this->addSql('CREATE TABLE controle_peche_moyen (controle_peche_id INT NOT NULL, moyen_id INT NOT NULL, PRIMARY KEY(controle_peche_id, moyen_id))');
        $this->addSql('CREATE INDEX IDX_9B472DFE8534A121 ON controle_peche_moyen (controle_peche_id)');
        $this->addSql('CREATE INDEX IDX_9B472DFE6C346E29 ON controle_peche_moyen (moyen_id)');
        $this->addSql('ALTER TABLE controle_peche_agent ADD CONSTRAINT FK_90A992B58534A121 FOREIGN KEY (controle_peche_id) REFERENCES controle_peche (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_peche_agent ADD CONSTRAINT FK_90A992B53414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_peche_moyen ADD CONSTRAINT FK_9B472DFE8534A121 FOREIGN KEY (controle_peche_id) REFERENCES controle_peche (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_peche_moyen ADD CONSTRAINT FK_9B472DFE6C346E29 FOREIGN KEY (moyen_id) REFERENCES moyen (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE form');
        $this->addSql('DROP TABLE submission');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_peche_moyen DROP CONSTRAINT FK_9B472DFE6C346E29');
        $this->addSql('ALTER TABLE controle_peche_agent DROP CONSTRAINT FK_90A992B53414710B');
        $this->addSql('ALTER TABLE controle_peche_agent DROP CONSTRAINT FK_90A992B58534A121');
        $this->addSql('ALTER TABLE controle_peche_moyen DROP CONSTRAINT FK_9B472DFE8534A121');
        $this->addSql('DROP SEQUENCE moyen_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_peche_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE submission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE form_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE form (id INT NOT NULL, active_version_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, version INT NOT NULL, creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_use TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, data JSONB NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_5288fd4f727aca70 ON form (parent_id)');
        $this->addSql('CREATE INDEX idx_5288fd4f6a1e45f3 ON form (active_version_id)');
        $this->addSql('CREATE TABLE submission (id INT NOT NULL, related_form_id INT NOT NULL, last_edition TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data JSONB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_db055af360ef51d8 ON submission (related_form_id)');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT fk_5288fd4f6a1e45f3 FOREIGN KEY (active_version_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT fk_5288fd4f727aca70 FOREIGN KEY (parent_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT fk_db055af360ef51d8 FOREIGN KEY (related_form_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE moyen');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE controle_peche');
        $this->addSql('DROP TABLE controle_peche_agent');
        $this->addSql('DROP TABLE controle_peche_moyen');
    }
}
