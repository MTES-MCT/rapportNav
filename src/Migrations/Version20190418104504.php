<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418104504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport ADD distance_terrestre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD aire_marine_speciale TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport.aire_marine_speciale IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE navire ADD type_usage INT DEFAULT 0');
        $this->addSql('ALTER TABLE navire ALTER type_usage DROP DEFAULT');
        $this->addSql('ALTER TABLE navire ALTER type_usage SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire DROP type_usage');
        $this->addSql('ALTER TABLE rapport DROP distance_terrestre');
        $this->addSql('ALTER TABLE rapport DROP aire_marine_speciale');
    }
}
