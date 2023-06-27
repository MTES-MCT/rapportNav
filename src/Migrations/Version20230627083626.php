<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627083626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle_unitaire ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_unitaire ADD date DATE DEFAULT NULL');
        $this->addSql('UPDATE controle_unitaire SET date = NOW() WHERE date IS NULL');
        $this->addSql('ALTER TABLE controle_unitaire ADD CONSTRAINT FK_BAED5723B03A8386 FOREIGN KEY (created_by_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BAED5723B03A8386 ON controle_unitaire (created_by_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_unitaire DROP CONSTRAINT FK_BAED5723B03A8386');
        $this->addSql('DROP INDEX IDX_BAED5723B03A8386');
        $this->addSql('ALTER TABLE controle_unitaire DROP created_by_id');
        $this->addSql('ALTER TABLE controle_unitaire DROP date');
    }
}
