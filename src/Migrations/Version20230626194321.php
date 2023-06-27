<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626194321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle_lot ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_lot ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE controle_lot ADD CONSTRAINT FK_5F95CE73B03A8386 FOREIGN KEY (created_by_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5F95CE73B03A8386 ON controle_lot (created_by_id)');
        $this->addSql('UPDATE controle_lot SET date = NOW() WHERE date IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_lot DROP CONSTRAINT FK_5F95CE73B03A8386');
        $this->addSql('DROP INDEX IDX_5F95CE73B03A8386');
        $this->addSql('ALTER TABLE controle_lot DROP created_by_id');
        $this->addSql('ALTER TABLE controle_lot DROP date');
    }
}
