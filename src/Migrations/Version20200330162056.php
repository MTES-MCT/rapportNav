<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200330162056 extends AbstractMigration {
    public function getDescription(): string {
        return 'Rename categorie_controle_navire to categorie_usage_navire';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire DROP CONSTRAINT fk_eed1038df83c9d5');
        $this->addSql('ALTER SEQUENCE categorie_controle_navire_id_seq RENAME TO categorie_usage_navire_id_seq');
        $this->addSql('ALTER TABLE categorie_controle_navire RENAME TO categorie_usage_navire');
        $this->addSql('DROP INDEX idx_eed1038df83c9d5');
        $this->addSql('ALTER TABLE navire RENAME COLUMN categorie_controle_navire_id TO categorie_usage_navire_id');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED103871E70F3F FOREIGN KEY (categorie_usage_navire_id) REFERENCES categorie_usage_navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EED103871E70F3F ON navire (categorie_usage_navire_id)');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE navire DROP CONSTRAINT FK_EED103871E70F3F');
        $this->addSql('ALTER SEQUENCE categorie_usage_navire_id_seq RENAME TO categorie_controle_navire_id_seq');
        $this->addSql('ALTER TABLE categorie_usage_navire RENAME TO categorie_controle_navire');
        $this->addSql('DROP INDEX IDX_EED103871E70F3F');
        $this->addSql('ALTER TABLE navire RENAME COLUMN categorie_usage_navire_id TO categorie_controle_navire_id');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT fk_eed1038df83c9d5 FOREIGN KEY (categorie_controle_navire_id) REFERENCES categorie_controle_navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_eed1038df83c9d5 ON navire (categorie_controle_navire_id)');
    }
}
