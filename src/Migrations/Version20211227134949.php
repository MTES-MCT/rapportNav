<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227134949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE category_pam_controle RENAME COLUMN label TO nom');
        $this->addSql('ALTER TABLE category_pam_indicateur RENAME COLUMN label TO nom');
        $this->addSql('ALTER TABLE category_pam_mission RENAME COLUMN label TO nom');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE category_pam_controle RENAME COLUMN nom TO label');
        $this->addSql('ALTER TABLE category_pam_indicateur RENAME COLUMN nom TO label');
        $this->addSql('ALTER TABLE category_pam_mission RENAME COLUMN nom TO label');
    }
}
