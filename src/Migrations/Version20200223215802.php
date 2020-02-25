<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200223215802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add detail on some fields. ';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE etablissement ADD detail_categorie_etablissement TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_loisir ADD detail_loisir TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD detail_controle TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_tache ADD detail_tache TEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE etablissement DROP detail_categorie_etablissement');
        $this->addSql('ALTER TABLE controle_navire DROP detail_controle');
        $this->addSql('ALTER TABLE controle_loisir DROP detail_loisir');
        $this->addSql('ALTER TABLE controle_tache DROP detail_tache');
    }
}
