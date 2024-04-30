<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430060102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_peche_nb_navire_controle_vhfmer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD lutte_peche_kg_produits_saisis_mer INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_peche_nb_navire_controle_vhfmer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP lutte_peche_kg_produits_saisis_mer');
    }
}
