<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213173522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire ADD aire_protegee BOOLEAN NOT NULL DEFAULT FALSE');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD aire_protegee BOOLEAN NOT NULL DEFAULT FALSE');
        $this->addSql('ALTER TABLE controle_loisir ADD nombre_controle_aire_protegee INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire DROP aire_protegee');
        $this->addSql('ALTER TABLE controle_pecheur_pied DROP aire_protegee');
        $this->addSql('ALTER TABLE controle_loisir DROP nombre_controle_aire_protegee');
    }
}
