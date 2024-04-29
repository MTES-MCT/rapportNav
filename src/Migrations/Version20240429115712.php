<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429115712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_heures_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_ope_aned INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_intervention_mise_en_demeure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_mise_en_demeure_evaluation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_mise_en_demeure_capinav INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_remorquages INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_ope_maintenance_signalisation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_ope_deminage INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_nb_munitions_detruites INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD assistance_poids_matiere_active INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_heures_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_ope_aned');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_intervention_mise_en_demeure');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_mise_en_demeure_evaluation');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_mise_en_demeure_capinav');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_remorquages');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_ope_maintenance_signalisation');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_ope_deminage');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_nb_munitions_detruites');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP assistance_poids_matiere_active');
    }
}
