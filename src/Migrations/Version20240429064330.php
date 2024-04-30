<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429064330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_nb_heure_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_nb_ope_conduites INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_nb_personnes_secourues INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_heures_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_ope_conduite INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_embarcations_sans_intervention INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_embarcations_assistees_terre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_ope_sauvetage_conduites INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD sauvegarde_humaine_migratoire_nb_personnes_secourues INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_nb_heure_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_nb_ope_conduites');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_nb_personnes_secourues');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_heures_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_ope_conduite');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_embarcations_sans_intervention');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_embarcations_retour_terre');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_ope_sauvetage_conduites');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP sauvegarde_humaine_migratoire_nb_personnes_secourues');
    }
}
