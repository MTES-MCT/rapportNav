<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190521111312 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    //Update trying to keep all data
    public function up(Schema $schema): void {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE zone_geographique_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE zone_geographique (id INT NOT NULL, nom VARCHAR(45) NOT NULL, alias VARCHAR(45) DEFAULT NULL, direction VARCHAR(45) NOT NULL, PRIMARY KEY(id))');

        $this->addSql('ALTER TABLE rapport ADD date_debut_mission TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE rapport SET date_debut_mission = date_mission');
        $this->addSql('ALTER TABLE rapport ALTER date_debut_mission SET NOT NULL');

        $this->addSql('ALTER TABLE rapport ADD date_fin_mission TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE rapport SET date_fin_mission = date_mission + INTERVAL \'1\' MINUTE * duree_mission::integer');
        $this->addSql('ALTER TABLE rapport ALTER date_fin_mission SET NOT NULL');

        $this->addSql('ALTER TABLE rapport ADD zone_mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C9E8DBD70 FOREIGN KEY (zone_mission_id) REFERENCES zone_geographique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BE34A09C9E8DBD70 ON rapport (zone_mission_id)');

        $this->addSql('ALTER TABLE rapport ADD detail_hors_zone TEXT DEFAULT NULL');

        $this->addSql('ALTER TABLE rapport DROP date_mission');
        $this->addSql('ALTER TABLE rapport DROP zone_mission');
        $this->addSql('ALTER TABLE rapport DROP duree_mission');
    }

    public function down(Schema $schema): void {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE zone_geographique_id_seq CASCADE');
        $this->addSql('DROP TABLE zone_geographique');
        $this->addSql('ALTER TABLE rapport ADD date_mission DATE NOT NULL');
        $this->addSql('ALTER TABLE rapport ADD zone_mission SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD duree_mission VARCHAR(255) NOT NULL');

        $this->addSql('UPDATE rapport SET date_mission = date_debut_mission');
        $this->addSql('UPDATE rapport SET duree_mission = date_debut_mission');

        $this->addSql('ALTER TABLE rapport DROP date_debut_mission');
        $this->addSql('ALTER TABLE rapport DROP date_fin_mission');
        $this->addSql('ALTER TABLE rapport DROP detail_hors_zone');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT fk_be34a09c9e8dbd70');
        $this->addSql('DROP INDEX IDX_BE34A09C9E8DBD70');
        $this->addSql('ALTER TABLE rapport DROP zone_mission_id');
    }
}
