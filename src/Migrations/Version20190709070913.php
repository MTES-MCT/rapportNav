<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709070913 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_etablissement ALTER natinf DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport_etablissement ALTER natinf TYPE TEXT');
        $this->addSql('COMMENT ON COLUMN rapport_etablissement.natinf IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ALTER natinf DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ALTER natinf TYPE TEXT');
        $this->addSql('COMMENT ON COLUMN rapport_pecheur_pied.natinf IS \'(DC2Type:array)\'');
        $this->addSql('UPDATE rapport_etablissement SET natinf = NULL');
        $this->addSql('UPDATE rapport_pecheur_pied SET natinf = NULL');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_pecheur_pied ALTER natinf TYPE VARCHAR(45)');
        $this->addSql('ALTER TABLE rapport_pecheur_pied ALTER natinf DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN rapport_pecheur_pied.natinf IS NULL');
        $this->addSql('ALTER TABLE rapport_etablissement ALTER natinf TYPE VARCHAR(45)');
        $this->addSql('ALTER TABLE rapport_etablissement ALTER natinf DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN rapport_etablissement.natinf IS NULL');
        $this->addSql('UPDATE rapport_etablissement SET natinf = NULL');
        $this->addSql('UPDATE rapport_pecheur_pied SET natinf = NULL');
    }
}
