<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429180907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD immigration_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD immigration_nb_navires_interceptes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD immigration_nb_migrant_interceptes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD immigration_nb_passeurs_interceptes INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP immigration_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP immigration_nb_navires_interceptes');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP immigration_nb_migrant_interceptes');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP immigration_nb_passeurs_interceptes');
    }
}
