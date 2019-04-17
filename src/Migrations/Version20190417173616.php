<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417173616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport ADD arme BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE rapport ALTER arme DROP DEFAULT ');
        $this->addSql('ALTER TABLE rapport ALTER arme SET NOT NULL ');
        $this->addSql('ALTER TABLE rapport ADD type_mission INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_navire ADD controles TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport_navire.controles IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rapport_navire DROP controles');
        $this->addSql('ALTER TABLE rapport DROP arme');
        $this->addSql('ALTER TABLE rapport DROP type_mission');
    }
}
