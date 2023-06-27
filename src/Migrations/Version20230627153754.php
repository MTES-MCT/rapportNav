<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627153754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle_unitaire ADD navire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_unitaire DROP enregistrement_navire');
        $this->addSql('ALTER TABLE controle_unitaire ALTER date SET NOT NULL');
        $this->addSql('ALTER TABLE controle_unitaire ADD CONSTRAINT FK_BAED5723D840FD82 FOREIGN KEY (navire_id) REFERENCES navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BAED5723D840FD82 ON controle_unitaire (navire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_unitaire DROP CONSTRAINT FK_BAED5723D840FD82');
        $this->addSql('DROP INDEX IDX_BAED5723D840FD82');
        $this->addSql('ALTER TABLE controle_unitaire ADD enregistrement_navire VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE controle_unitaire DROP navire_id');
        $this->addSql('ALTER TABLE controle_unitaire ALTER date DROP NOT NULL');
    }
}
