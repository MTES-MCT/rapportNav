<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129163459 extends AbstractMigration {
    public function getDescription(): string {
        return 'Add more possibilities for ControleNavire';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categorie_deroutement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie_deroutement (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE controle_navire ADD deroutement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT FK_43CC3BA290684EFE FOREIGN KEY (deroutement_id) REFERENCES categorie_deroutement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_43CC3BA290684EFE ON controle_navire (deroutement_id)');
        $this->addSql('ALTER TABLE controle_navire ADD chloredecone_total BOOLEAN DEFAULT \'false\' NOT NULL;');
        $this->addSql('ALTER TABLE controle_navire ADD chloredecone_partiel BOOLEAN DEFAULT \'false\' NOT NULL;');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD chloredecone_total BOOLEAN DEFAULT \'false\' NOT NULL;');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD chloredecone_partiel BOOLEAN DEFAULT \'false\' NOT NULL;');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_chlordecone_total_mer INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_chlordecone_total_terre INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_chlordecone_partiel_mer INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_chlordecone_partiel_terre INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE categorie_controle_autre ADD complement_donnee TEXT DEFAULT NULL;');
        $this->addSql('ALTER TABLE controle_autre ADD nombre_chlordecone INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE controle_autre ADD nombre_detruit INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire DROP CONSTRAINT FK_43CC3BA290684EFE');
        $this->addSql('DROP SEQUENCE categorie_deroutement_id_seq CASCADE');
        $this->addSql('DROP TABLE categorie_deroutement');
        $this->addSql('DROP INDEX IDX_43CC3BA290684EFE');
        $this->addSql('ALTER TABLE controle_navire DROP deroutement_id');
    }
}
