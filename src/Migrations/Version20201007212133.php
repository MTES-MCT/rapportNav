<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007212133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Ajout des contrôles effectuées à terre entrées en masse. Attention le downgrade fait PERDRE de l\'information et efface les contrôles à terre.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire_sans_pv ADD nombre_controle_terre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_navire_sans_pv RENAME COLUMN nombre_controle TO nombre_controle_mer');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_navire_sans_pv RENAME COLUMN nombre_controle_mer TO nombre_controle');
        $this->addSql('ALTER TABLE controle_navire_sans_pv DROP nombre_controle_terre');
    }
}
