<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190730154920 extends AbstractMigration {

    public function getDescription(): string {
        return 'This migration DOES create data loss as information of Rapport\<object\>::Natinfs is not reported to the new ManytoMany Rapport\<Object\> <-> Natinf, same goes to RapportNavire::controles and M2M RapportNavire <-> RapportMissionControle';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE natinf_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_navire_controle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_mission_controle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE moyen_type_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_methode_ciblage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE natinf (id INT NOT NULL, numero INT NOT NULL, description TEXT DEFAULT NULL, libelle TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rapport_navire_controle (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_mission_controle (id INT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, zone_geographique_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD2355BDC74 ON service (zone_geographique_id)');
        $this->addSql('CREATE TABLE moyen_type_navire (id INT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rapport_etablissement_natinf (rapport_etablissement_id INT NOT NULL, natinf_id INT NOT NULL, PRIMARY KEY(rapport_etablissement_id, natinf_id))');
        $this->addSql('CREATE INDEX IDX_8B3E4E9E8040F1B5 ON rapport_etablissement_natinf (rapport_etablissement_id)');
        $this->addSql('CREATE INDEX IDX_8B3E4E9EF87A39C6 ON rapport_etablissement_natinf (natinf_id)');
        $this->addSql('CREATE TABLE rapport_pecheur_pied_natinf (rapport_pecheur_pied_id INT NOT NULL, natinf_id INT NOT NULL, PRIMARY KEY(rapport_pecheur_pied_id, natinf_id))');
        $this->addSql('CREATE TABLE rapport_methode_ciblage (id INT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C57F495D1CDC648 ON rapport_pecheur_pied_natinf (rapport_pecheur_pied_id)');
        $this->addSql('CREATE INDEX IDX_4C57F495F87A39C6 ON rapport_pecheur_pied_natinf (natinf_id)');
        $this->addSql('CREATE TABLE rapport_navire_rapport_navire_controle (rapport_navire_id INT NOT NULL, rapport_navire_controle_id INT NOT NULL, PRIMARY KEY(rapport_navire_id, rapport_navire_controle_id))');
        $this->addSql('CREATE INDEX IDX_8E1D4640DB22DF6E ON rapport_navire_rapport_navire_controle (rapport_navire_id)');
        $this->addSql('CREATE INDEX IDX_8E1D464060D5758C ON rapport_navire_rapport_navire_controle (rapport_navire_controle_id)');
        $this->addSql('CREATE TABLE rapport_navire_natinf (rapport_navire_id INT NOT NULL, natinf_id INT NOT NULL, PRIMARY KEY(rapport_navire_id, natinf_id))');
        $this->addSql('CREATE INDEX IDX_E3CA9AB5DB22DF6E ON rapport_navire_natinf (rapport_navire_id)');
        $this->addSql('CREATE INDEX IDX_E3CA9AB5F87A39C6 ON rapport_navire_natinf (natinf_id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2355BDC74 FOREIGN KEY (zone_geographique_id) REFERENCES zone_geographique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf ADD CONSTRAINT FK_8B3E4E9E8040F1B5 FOREIGN KEY (rapport_etablissement_id) REFERENCES rapport_etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf ADD CONSTRAINT FK_8B3E4E9EF87A39C6 FOREIGN KEY (natinf_id) REFERENCES natinf (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf ADD CONSTRAINT FK_4C57F495D1CDC648 FOREIGN KEY (rapport_pecheur_pied_id) REFERENCES rapport_pecheur_pied (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf ADD CONSTRAINT FK_4C57F495F87A39C6 FOREIGN KEY (natinf_id) REFERENCES natinf (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle ADD CONSTRAINT FK_8E1D4640DB22DF6E FOREIGN KEY (rapport_navire_id) REFERENCES rapport_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle ADD CONSTRAINT FK_8E1D464060D5758C FOREIGN KEY (rapport_navire_controle_id) REFERENCES rapport_navire_controle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire_natinf ADD CONSTRAINT FK_E3CA9AB5DB22DF6E FOREIGN KEY (rapport_navire_id) REFERENCES rapport_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_navire_natinf ADD CONSTRAINT FK_E3CA9AB5F87A39C6 FOREIGN KEY (natinf_id) REFERENCES natinf (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        //New tables have been created. Now we fill them with the old values (stored as int/smallint) in fields which will be transformed to ManyToOne
        $this->addSql('INSERT INTO type_mission_controle (id, nom) VALUES (0, \'Visite de sécurité\'), (1, \'Contrôle de navire(s)\'), (2, \'Surveillance d\'\'aire marine\')');
        $this->addSql('INSERT INTO service (id, nom) VALUES (0, \'ulam35\'), (1, \'ulam56\')');
        $this->addSql('INSERT INTO rapport_methode_ciblage (id, nom) VALUES (0, \'Ciblé via outil\'), (1, \'Ciblé manuellement\'), (2, \'Opportunité\')');
        $this->addSql('INSERT INTO rapport_navire_controle (id, nom) VALUES (0, \'Contrôles Pêche / Sanitaire\'), (1, \'Environnement / pollution\'), (2, \'Équipement de sécurité / Permis de navigation\'), (3, \'Réglementation du travail maritime\'), (4, \'Police de la navigation\'), (5, \'Autre\')');

        $this->addSql('ALTER TABLE rapport RENAME COLUMN methode_ciblage TO methode_ciblage_id');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN methode_ciblage_id SET DATA TYPE INT');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN methode_ciblage_id SET DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C54EED909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BE34A09C54EED909 ON rapport (methode_ciblage_id)');

        $this->addSql('ALTER TABLE rapport RENAME COLUMN lieu_mission TO terrestre');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN terrestre SET DATA TYPE BOOLEAN USING (terrestre::int)::boolean');
        // Column was already not null when integer
        $this->addSql('ALTER TABLE rapport ALTER COLUMN terrestre SET NOT NULL');

        $this->addSql('ALTER TABLE rapport RENAME COLUMN type_mission TO type_mission_controle_id');
        $this->addSql('CREATE INDEX IDX_BE34A09C94A2DFE8 ON rapport (type_mission_controle_id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C94A2DFE8 FOREIGN KEY (type_mission_controle_id) REFERENCES type_mission_controle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE rapport DROP aire_marine_speciale');

        $this->addSql('ALTER TABLE rapport RENAME COLUMN service_createur TO service_createur_id');
        $this->addSql('UPDATE rapport SET service_createur_id = 0 WHERE service_createur_id = \'ulam35\'');
        $this->addSql('UPDATE rapport SET service_createur_id = 1 WHERE service_createur_id = \'ulam56\'');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN service_createur_id SET DATA TYPE INT USING (service_createur_id::int)');
        // Column was already not null, just ensuring....
        $this->addSql('ALTER TABLE rapport ALTER COLUMN service_createur_id SET NOT NULL');
        $this->addSql('CREATE INDEX IDX_BE34A09CBF382749 ON rapport (service_createur_id)');

        $this->addSql('ALTER TABLE "user" ADD service_id INT DEFAULT NULL');
        $this->addSql('UPDATE "user" SET service_id = 0 WHERE username = \'ulam35\'');
        $this->addSql('UPDATE "user" SET service_id = 1 WHERE username = \'ulam56\'');

        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649ED5CA9E6 ON "user" (service_id)');

        $this->addSql('ALTER TABLE moyen RENAME COLUMN type TO terrestre');
        $this->addSql('ALTER TABLE moyen ALTER COLUMN terrestre SET DATA TYPE BOOLEAN USING (terrestre::int)::boolean');
        // Column was already not null when integer
        $this->addSql('ALTER TABLE moyen ALTER terrestre SET NOT NULL');

        $this->addSql('ALTER TABLE moyen RENAME COLUMN possesseur TO service_proprietaire_id');
        $this->addSql('UPDATE moyen SET service_proprietaire_id = 0 WHERE service_proprietaire_id = \'ulam35\'');
        $this->addSql('UPDATE moyen SET service_proprietaire_id = 1 WHERE service_proprietaire_id = \'ulam56\'');
        $this->addSql('ALTER TABLE moyen ALTER COLUMN service_proprietaire_id SET DATA TYPE INT USING (service_proprietaire_id::int)');
        $this->addSql('ALTER TABLE moyen ADD CONSTRAINT FK_2D6523D654C47EAE FOREIGN KEY (service_proprietaire_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2D6523D654C47EAE ON moyen (service_proprietaire_id)');

        $this->addSql('ALTER TABLE moyen ADD type_navire_id INT');
        $this->addSql('ALTER TABLE moyen ADD CONSTRAINT FK_2D6523D66C86BC92 FOREIGN KEY (type_navire_id) REFERENCES moyen_type_navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2D6523D66C86BC92 ON moyen (type_navire_id)');

        //changing string with services to id defined above
        $this->addSql('UPDATE agent SET service = 0 WHERE service = \'ulam35\'');
        $this->addSql('UPDATE agent SET service = 1 WHERE service = \'ulam56\'');
        $this->addSql('ALTER TABLE agent RENAME COLUMN service TO service_id');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service_id SET DATA TYPE INT USING (service_id::int)');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service_id DROP NOT NULL');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service_id SET DEFAULT NULL');

        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_268B9C9DED5CA9E6 ON agent (service_id)');

        $this->addSql('ALTER TABLE rapport_etablissement DROP natinf');

        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP natinf');

        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CBF382749 FOREIGN KEY (service_createur_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE rapport_navire DROP natinf');
        $this->addSql('ALTER TABLE rapport_navire DROP controles');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_etablissement_natinf DROP CONSTRAINT FK_8B3E4E9EF87A39C6');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf DROP CONSTRAINT FK_4C57F495F87A39C6');
        $this->addSql('ALTER TABLE rapport_navire_natinf DROP CONSTRAINT FK_E3CA9AB5F87A39C6');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle DROP CONSTRAINT FK_8E1D464060D5758C');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT FK_BE34A09C94A2DFE8');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT FK_BE34A09CBF382749');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT FK_BE34A09C54EED909');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649ED5CA9E6');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT FK_268B9C9DED5CA9E6');
        $this->addSql('ALTER TABLE moyen DROP CONSTRAINT FK_2D6523D66C86BC92');
        $this->addSql('DROP SEQUENCE natinf_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_navire_controle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_mission_controle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE moyen_type_navire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_methode_ciblage_id_seq CASCADE');
        $this->addSql('ALTER TABLE rapport_navire ADD natinf TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_navire ADD controles TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport_navire.natinf IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN rapport_navire.controles IS \'(DC2Type:array)\'');
        $this->addSql('DROP INDEX IDX_8D93D649ED5CA9E6');
        $this->addSql('ALTER TABLE "user" DROP service_id');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ADD natinf TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport_pecheur_pied.natinf IS \'(DC2Type:array)\'');
        $this->addSql('DROP INDEX IDX_2D6523D66C86BC92');
        $this->addSql('ALTER TABLE moyen DROP type_navire_id');
        $this->addSql('ALTER TABLE moyen RENAME COLUMN terrestre TO type');
        $this->addSql('ALTER TABLE moyen ALTER COLUMN type SET DATA TYPE INT USING (type::boolean)::int');
        $this->addSql('ALTER TABLE moyen ALTER type SET NOT NULL');


        $this->addSql('ALTER TABLE moyen DROP CONSTRAINT FK_2D6523D654C47EAE');
        $this->addSql('DROP INDEX IDX_2D6523D654C47EAE');
        $this->addSql('ALTER TABLE moyen RENAME COLUMN service_proprietaire_id TO possesseur');
        $this->addSql('ALTER TABLE moyen ALTER COLUMN possesseur SET DATA TYPE VARCHAR(45) USING (possesseur::varchar(45))');
        $this->addSql('UPDATE moyen SET possesseur = \'ulam35\' WHERE possesseur = \'0\'');
        $this->addSql('UPDATE moyen SET possesseur = \'ulam56\' WHERE possesseur = \'1\'');

        $this->addSql('DROP INDEX IDX_268B9C9DED5CA9E6');

        $this->addSql('ALTER TABLE agent RENAME COLUMN service_id TO service');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service SET DATA TYPE VARCHAR(45) USING (service::varchar)');
        $this->addSql('UPDATE agent SET service = \'ulam35\' WHERE service = \'0\'');
        $this->addSql('UPDATE agent SET service = \'ulam56\' WHERE service = \'1\'');
        $this->addSql('UPDATE agent SET service = -1 WHERE service IS NULL');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service DROP DEFAULT');
        $this->addSql('ALTER TABLE agent ALTER COLUMN service SET NOT NULL');

        $this->addSql('ALTER TABLE rapport_etablissement ADD natinf TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport_etablissement.natinf IS \'(DC2Type:array)\'');

        $this->addSql('ALTER TABLE rapport RENAME COLUMN terrestre TO lieu_mission');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN lieu_mission SET DATA TYPE SMALLINT USING (lieu_mission::integer)::smallint');

        $this->addSql('DROP INDEX IDX_BE34A09C94A2DFE8');
        $this->addSql('ALTER TABLE rapport RENAME COLUMN type_mission_controle_id TO type_mission');
        $this->addSql('ALTER TABLE rapport ADD aire_marine_speciale TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport.aire_marine_speciale IS \'(DC2Type:array)\'');

        $this->addSql('DROP INDEX IDX_BE34A09CBF382749');
        $this->addSql('ALTER TABLE rapport RENAME COLUMN service_createur_id TO service_createur');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN service_createur SET DATA TYPE VARCHAR(45) USING (service_createur::varchar(45))');
        $this->addSql('UPDATE rapport SET service_createur = \'ulam35\' WHERE service_createur = \'0\'');
        $this->addSql('UPDATE rapport SET service_createur = \'ulam56\' WHERE service_createur = \'1\'');
        // Column was already not null, just ensuring....
        $this->addSql('ALTER TABLE rapport ALTER COLUMN service_createur SET NOT NULL');

        $this->addSql('DROP INDEX IDX_BE34A09C54EED909');
        $this->addSql('ALTER TABLE rapport RENAME COLUMN methode_ciblage_id TO methode_ciblage');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN methode_ciblage SET DATA TYPE SMALLINT');
        $this->addSql('ALTER TABLE rapport ALTER COLUMN methode_ciblage SET DEFAULT NULL');


        $this->addSql('DROP TABLE natinf');
        $this->addSql('DROP TABLE rapport_navire_controle');
        $this->addSql('DROP TABLE type_mission_controle');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE moyen_type_navire');
        $this->addSql('DROP TABLE rapport_etablissement_natinf');
        $this->addSql('DROP TABLE rapport_pecheur_pied_natinf');
        $this->addSql('DROP TABLE rapport_navire_rapport_navire_controle');
        $this->addSql('DROP TABLE rapport_navire_natinf');
        $this->addSql('DROP TABLE rapport_methode_ciblage');

    }
}
