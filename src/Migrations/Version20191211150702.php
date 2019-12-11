<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211150702 extends AbstractMigration {
    public function getDescription(): string {
        return 'Remove need for id_nav_flotteur in navire table ';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire ALTER id_nav_floteur DROP NOT NULL');
        $this->addSql('ALTER TABLE navire RENAME id_nav_floteur TO id_nav_flotteur');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire RENAME id_nav_flotteur TO id_nav_floteur');
        $this->addSql('ALTER TABLE navire ALTER id_nav_floteur SET NOT NULL');
    }
}
