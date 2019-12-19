<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191219162127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_pecheur_pied ADD date TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE controle_pecheur_pied SET date = (
                            SELECT date_debut_mission FROM rapport JOIN mission AS m ON m.rapport_id=rapport.id WHERE controle_pecheur_pied.rapport_id = m.id)');
        $this->addSql('ALTER TABLE controle_pecheur_pied ALTER date SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN controle_pecheur_pied.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE controle_etablissement ADD date TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE controle_etablissement SET date = (
                            SELECT date_debut_mission FROM rapport JOIN mission AS m ON m.rapport_id=rapport.id WHERE controle_etablissement.rapport_id = m.id)');
        $this->addSql('ALTER TABLE controle_etablissement ALTER date SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN controle_etablissement.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE controle_navire ADD date TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE controle_navire SET date = (
                            SELECT date_debut_mission FROM rapport JOIN mission AS m ON m.rapport_id=rapport.id WHERE controle_navire.rapport_id = m.id)');
        $this->addSql('ALTER TABLE controle_navire ALTER date SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN controle_navire.date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_etablissement DROP date');
        $this->addSql('ALTER TABLE controle_navire DROP date');
        $this->addSql('ALTER TABLE controle_pecheur_pied DROP date');
    }
}
