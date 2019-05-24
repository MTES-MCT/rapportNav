<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524162412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE rapport_zone_geographique (rapport_id INT NOT NULL, zone_geographique_id INT NOT NULL, PRIMARY KEY(rapport_id, zone_geographique_id))');
        $this->addSql('CREATE INDEX IDX_572AD6B01DFBCC46 ON rapport_zone_geographique (rapport_id)');
        $this->addSql('CREATE INDEX IDX_572AD6B0355BDC74 ON rapport_zone_geographique (zone_geographique_id)');
        $this->addSql('ALTER TABLE rapport_zone_geographique ADD CONSTRAINT FK_572AD6B01DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_zone_geographique ADD CONSTRAINT FK_572AD6B0355BDC74 FOREIGN KEY (zone_geographique_id) REFERENCES zone_geographique (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT fk_be34a09c9e8dbd70');
        $this->addSql('DROP INDEX idx_be34a09c9e8dbd70');

        $this->addSql('ALTER TABLE rapport DROP zone_mission_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE rapport_zone_geographique');
        $this->addSql('ALTER TABLE rapport ADD zone_mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT fk_be34a09c9e8dbd70 FOREIGN KEY (zone_mission_id) REFERENCES zone_geographique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_be34a09c9e8dbd70 ON rapport (zone_mission_id)');
    }
}
