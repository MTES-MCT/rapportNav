<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430060447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD protection_culturel_nb_heures_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD protection_culturel_nb_ope_scientifiques INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD protection_culturel_nb_ope_police_bcm INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP protection_culturel_nb_heures_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP protection_culturel_nb_ope_scientifiques');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP protection_culturel_nb_ope_police_bcm');
    }
}
