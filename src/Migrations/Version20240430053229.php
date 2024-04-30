<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430053229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_participation_antipol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_deploiement_en_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_nb_infractions INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_pv INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_nb_deroutements INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_pollution_nb_pollutions_detectees INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_participation_antipol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_deploiement_en_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_nb_infractions');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_pv');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_nb_deroutements');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_pollution_nb_pollutions_detectees');
    }
}
