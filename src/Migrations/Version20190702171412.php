<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190702171412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_navire ALTER natinf TYPE TEXT');
        $this->addSql('ALTER TABLE rapport_navire ALTER natinf DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN rapport_navire.natinf IS \'(DC2Type:array)\'');
        $this->addSql('UPDATE rapport_navire SET natinf = NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_navire ALTER natinf TYPE VARCHAR(45)');
        $this->addSql('ALTER TABLE rapport_navire ALTER natinf DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN rapport_navire.natinf IS NULL');
    }
}