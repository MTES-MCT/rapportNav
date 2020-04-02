<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402125848 extends AbstractMigration {
    public function getDescription(): string {
        return 'Refactor Mission to Activite, impact on mission and mission_zone_geographique tables. ';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE mission_id_seq RENAME TO activite_id_seq');
        $this->addSql('ALTER TABLE mission RENAME TO activite');

        $this->addSql('ALTER TABLE mission_zone_geographique DROP CONSTRAINT fk_be0bbe32be6cae90');
        $this->addSql('ALTER TABLE mission_zone_geographique RENAME TO activite_zone_geographique');
        $this->addSql('ALTER TABLE activite_zone_geographique RENAME COLUMN mission_id TO activite_id');
        $this->addSql('CREATE INDEX IDX_893872529B0F88B1 ON activite_zone_geographique (activite_id)');
        $this->addSql('ALTER TABLE activite_zone_geographique ADD CONSTRAINT FK_893872529B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER INDEX idx_9067f23c1dfbcc46 RENAME TO IDX_B87555151DFBCC46');
        $this->addSql('ALTER INDEX idx_9067f23c1c4482b5 RENAME TO IDX_B87555151C4482B5');
        $this->addSql('ALTER INDEX idx_9067f23cd24c3c2e RENAME TO IDX_B8755515D24C3C2E');
        $this->addSql('ALTER INDEX idx_9067f23c93eb745f RENAME TO IDX_B875551593EB745F');
        $this->addSql('DROP INDEX idx_be0bbe32be6cae90');
        $this->addSql('ALTER INDEX idx_be0bbe32355bdc74 RENAME TO IDX_89387252355BDC74;');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE activite_id_seq RENAME TO mission_id_seq');
        $this->addSql('ALTER TABLE activite RENAME TO mission');

        $this->addSql('ALTER TABLE activite_zone_geographique DROP CONSTRAINT FK_893872529B0F88B1');
        $this->addSql('ALTER TABLE activite_zone_geographique RENAME TO mission_zone_geographique');
        $this->addSql('ALTER TABLE mission_zone_geographique RENAME COLUMN activite_id TO mission_id');
        $this->addSql('ALTER TABLE mission_zone_geographique ADD CONSTRAINT fk_be0bbe32be6cae90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX IDX_B87555151DFBCC46 RENAME TO idx_9067f23c1dfbcc46');
        $this->addSql('ALTER INDEX IDX_B87555151C4482B5 RENAME TO idx_9067f23c1c4482b5');
        $this->addSql('ALTER INDEX IDX_B8755515D24C3C2E RENAME TO idx_9067f23cd24c3c2e');
        $this->addSql('ALTER INDEX IDX_B875551593EB745F RENAME TO idx_9067f23c93eb745f');
        $this->addSql('ALTER INDEX IDX_89387252355BDC74 RENAME TO idx_be0bbe32355bdc74;');
        $this->addSql('ALTER INDEX idx_893872529b0f88b1 RENAME TO IDX_BE0BBE32BE6CAE90;');
    }
}
