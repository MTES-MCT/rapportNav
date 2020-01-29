<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129092601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tache ADD complement_donnee TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_tache ADD nombre_dossiers INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_aerien INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_pollution_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_pollution_terre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_pollution_aerien INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_environnement_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_environnement_terre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_environnement_aerien INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_croise INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD immigration INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD controle_aire_protegee_aerien INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance INT DEFAULT NULL');

        $this->addSql('UPDATE rapport_repartition_heures rrh 
                                SET assistance = (SELECT extract(hour from duree_secours)*60 + extract(minutes from duree_secours) AS ds 
                                    FROM mission m
                                    LEFT JOIN rapport r on m.rapport_id = r.id
                                    WHERE r.id = rrh.rapport_id AND m.discr=\'secours\');');

        $this->addSql('ALTER TABLE rapport_repartition_heures DROP nombre_operation_maintien_ordre');
        $this->addSql('ALTER TABLE mission DROP duree_secours');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mission ADD duree_secours TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE tache DROP complement_donnee');
        $this->addSql('ALTER TABLE controle_tache DROP nombre_dossiers');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD nombre_operation_maintien_ordre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP controle_aire_protegee_aerien');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP controle_pollution_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP controle_pollution_terre');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP controle_pollution_aerien');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP controle_croise');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP immigration');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance');
    }
}
