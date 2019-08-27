<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190827092601 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE mission AS (SELECT * FROM rapport)');
        $this->addSql('ALTER TABLE rapport_zone_geographique RENAME TO mission_zone_geographique');

        $this->addSql('CREATE SEQUENCE mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE mission ADD gps_lat NUMERIC(10, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD gps_lng NUMERIC(11, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD rapport_id INT DEFAULT NULL');
        $this->addSql('UPDATE mission SET rapport_id = id');
        $this->addSql('ALTER TABLE mission ALTER COLUMN rapport_id SET NOT NULL');
        $this->addSql('ALTER TABLE mission DROP arme');
        $this->addSql('ALTER TABLE mission DROP date_debut_mission');
        $this->addSql('ALTER TABLE mission DROP date_fin_mission');
        $this->addSql('ALTER TABLE mission DROP detail_hors_zone');
        $this->addSql('ALTER TABLE mission DROP service_createur_id');
        $this->addSql('ALTER TABLE mission ALTER id SET NOT NULL');
        $this->addSql('ALTER TABLE mission ALTER terrestre SET NOT NULL');
        $this->addSql('ALTER TABLE mission ALTER discr SET NOT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C94A2DFE8 FOREIGN KEY (type_mission_controle_id) REFERENCES type_mission_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C54EED909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9067F23C1DFBCC46 ON mission (rapport_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C94A2DFE8 ON mission (type_mission_controle_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C54EED909 ON mission (methode_ciblage_id)');
        $this->addSql('ALTER TABLE mission ADD PRIMARY KEY (id)');
        $this->addSql('UPDATE mission SET discr = \'navire\' WHERE discr = \'bord\'');

        $this->addSql('ALTER TABLE mission_zone_geographique DROP CONSTRAINT fk_572ad6b01dfbcc46');
        $this->addSql('DROP INDEX idx_572ad6b01dfbcc46');
        $this->addSql('ALTER TABLE mission_zone_geographique DROP CONSTRAINT "rapport_zone_geographique_pkey"');
        $this->addSql('ALTER TABLE mission_zone_geographique RENAME COLUMN rapport_id TO mission_id');
        $this->addSql('ALTER TABLE mission_zone_geographique ADD CONSTRAINT FK_BE0BBE32BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BE0BBE32BE6CAE90 ON mission_zone_geographique (mission_id)');
        $this->addSql('ALTER TABLE mission_zone_geographique ADD PRIMARY KEY (mission_id, zone_geographique_id)');
        $this->addSql('ALTER INDEX idx_572ad6b0355bdc74 RENAME TO IDX_BE0BBE32355BDC74');

        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT fk_be34a09c54eed909');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT fk_be34a09c94a2dfe8');
        $this->addSql('DROP INDEX idx_be34a09c54eed909');
        $this->addSql('DROP INDEX idx_be34a09c94a2dfe8');
        $this->addSql('ALTER TABLE rapport DROP methode_ciblage_id');
        $this->addSql('ALTER TABLE rapport DROP terrestre');
        $this->addSql('ALTER TABLE rapport DROP discr');
        $this->addSql('ALTER TABLE rapport DROP type_mission_controle_id');
        $this->addSql('ALTER TABLE rapport DROP detail_hors_zone');
        $this->addSql('ALTER TABLE rapport DROP activite');
        $this->addSql('ALTER TABLE rapport DROP formation');

        $this->addSql('ALTER TABLE rapport_etablissement DROP CONSTRAINT FK_495F6DBD1DFBCC46');
        $this->addSql('ALTER TABLE rapport_etablissement ADD CONSTRAINT FK_495F6DBD1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP CONSTRAINT FK_A31F41AE1DFBCC46');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ADD CONSTRAINT FK_A31F41AE1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire DROP CONSTRAINT FK_6FA6DDF21DFBCC46');
        $this->addSql('ALTER TABLE rapport_navire ADD CONSTRAINT FK_6FA6DDF21DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('DROP SEQUENCE mission_id_seq CASCADE');
        $this->addSql('ALTER TABLE mission_zone_geographique DROP CONSTRAINT FK_BE0BBE32BE6CAE90');
        $this->addSql('DROP INDEX IDX_BE0BBE32BE6CAE90');

        $this->addSql('ALTER TABLE mission_zone_geographique DROP CONSTRAINT "mission_zone_geographique_pkey"');
        $this->addSql('ALTER TABLE mission_zone_geographique RENAME COLUMN mission_id TO rapport_id');
        $this->addSql('ALTER TABLE mission_zone_geographique ADD CONSTRAINT fk_572ad6b01dfbcc46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_572ad6b01dfbcc46 ON mission_zone_geographique (rapport_id)');
        $this->addSql('ALTER TABLE mission_zone_geographique ADD PRIMARY KEY (rapport_id, zone_geographique_id)');
        $this->addSql('ALTER INDEX idx_be0bbe32355bdc74 RENAME TO idx_572ad6b0355bdc74');
        $this->addSql('ALTER TABLE rapport_etablissement DROP CONSTRAINT fk_495f6dbd1dfbcc46');
        $this->addSql('ALTER TABLE rapport_etablissement ADD CONSTRAINT fk_495f6dbd1dfbcc46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE rapport ADD methode_ciblage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD type_mission_controle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD terrestre BOOLEAN DEFAULT FALSE');
        $this->addSql('UPDATE rapport SET terrestre = m.terrestre FROM mission AS m WHERE m.id = rapport.id');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN terrestre DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN terrestre SET NOT NULL');

        $this->addSql('ALTER TABLE rapport ADD discr VARCHAR(255) DEFAULT \'\'');
        $this->addSql('UPDATE rapport SET discr = m.discr FROM mission AS m WHERE m.id = rapport.id');
        $this->addSql('ALTER TABLE rapport ALTER discr DROP DEFAULT ');
        $this->addSql('ALTER TABLE rapport ALTER discr SET NOT NULL');

        $this->addSql('ALTER TABLE rapport ADD detail_hors_zone TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD activite TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD formation TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT fk_be34a09c54eed909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT fk_be34a09c94a2dfe8 FOREIGN KEY (type_mission_controle_id) REFERENCES type_mission_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_be34a09c54eed909 ON rapport (methode_ciblage_id)');
        $this->addSql('CREATE INDEX idx_be34a09c94a2dfe8 ON rapport (type_mission_controle_id)');
        $this->addSql('UPDATE rapport SET discr = \'bord\' WHERE discr = \'navire\'');

        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP CONSTRAINT fk_a31f41ae1dfbcc46');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ADD CONSTRAINT fk_a31f41ae1dfbcc46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire DROP CONSTRAINT fk_6fa6ddf21dfbcc46');
        $this->addSql('ALTER TABLE rapport_navire ADD CONSTRAINT fk_6fa6ddf21dfbcc46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C1DFBCC46');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C94A2DFE8');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C54EED909');
        $this->addSql('DROP INDEX IDX_9067F23C1DFBCC46');
        $this->addSql('DROP INDEX IDX_9067F23C94A2DFE8');
        $this->addSql('DROP INDEX IDX_9067F23C54EED909');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT "mission_pkey"');
        $this->addSql('ALTER TABLE mission ADD arme BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD date_debut_mission TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD date_fin_mission TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD detail_hors_zone TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD service_createur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission DROP rapport_id');
        $this->addSql('ALTER TABLE mission DROP gps_lat');
        $this->addSql('ALTER TABLE mission DROP gps_lng');
        $this->addSql('ALTER TABLE mission ALTER id DROP NOT NULL');
        $this->addSql('ALTER TABLE mission ALTER terrestre DROP NOT NULL');
        $this->addSql('ALTER TABLE mission ALTER discr DROP NOT NULL');

        $this->addSql('DROP TABLE mission');
        $this->addSql('ALTER TABLE mission_zone_geographique RENAME TO rapport_zone_geographique');
        $this->addSql('ALTER INDEX mission_zone_geographique_pkey RENAME TO rapport_zone_geographique_pkey');

    }
}
