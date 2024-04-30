<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430064724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD souverainete_nb_navire_approche_maritime INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD souverainete_nb_heures_mer_piraterie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD souverainete_nb_heures_vol_piraterie INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP souverainete_nb_navire_approche_maritime');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP souverainete_nb_heures_mer_piraterie');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP souverainete_nb_heures_vol_piraterie');
    }
}
