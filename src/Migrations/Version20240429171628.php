<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429171628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_trafic_especes_nb_heures_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_trafic_especes_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_trafic_especes_nb_navires_saisis_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_trafic_especes_nb_saisis INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_trafic_especes_nb_heures_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_trafic_especes_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_trafic_especes_nb_navires_saisis_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_trafic_especes_nb_saisis');
    }
}
