<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422085308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle_lot ADD created_by_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_lot ADD CONSTRAINT FK_5F95CE737D182D95 FOREIGN KEY (created_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5F95CE737D182D95 ON controle_lot (created_by_user_id)');
        $this->addSql('ALTER TABLE controle_unitaire ADD created_by_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_unitaire ADD CONSTRAINT FK_BAED57237D182D95 FOREIGN KEY (created_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BAED57237D182D95 ON controle_unitaire (created_by_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_unitaire DROP CONSTRAINT FK_BAED57237D182D95');
        $this->addSql('DROP INDEX IDX_BAED57237D182D95');
        $this->addSql('ALTER TABLE controle_unitaire DROP created_by_user_id');
        $this->addSql('ALTER TABLE controle_lot DROP CONSTRAINT FK_5F95CE737D182D95');
        $this->addSql('DROP INDEX IDX_5F95CE737D182D95');
        $this->addSql('ALTER TABLE controle_lot DROP created_by_user_id');
    }
}
