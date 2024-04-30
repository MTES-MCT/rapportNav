<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430062401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD surete_maritime_nb_heures_vol INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD surete_maritime_nb_ope_mer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD surete_maritime_nb_traversees_protegees INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP surete_maritime_nb_heures_vol');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP surete_maritime_nb_ope_mer');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP surete_maritime_nb_traversees_protegees');
    }
}
