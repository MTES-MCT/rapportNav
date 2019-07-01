<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701122746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT fk_9b472dfe6c346e29');
        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT FK_D573A081DFBCC46');
        $this->addSql('ALTER TABLE rapport_moyen ADD distance INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_moyen ADD temps_moteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_moyen ADD CONSTRAINT FK_D573A086C346E29 FOREIGN KEY (moyen_id) REFERENCES moyen (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_moyen ADD CONSTRAINT FK_D573A081DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT FK_D573A086C346E29');
        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT fk_d573a081dfbcc46');
        $this->addSql('ALTER TABLE rapport_moyen DROP distance');
        $this->addSql('ALTER TABLE rapport_moyen DROP temps_moteur');
        $this->addSql('ALTER TABLE rapport_moyen ADD CONSTRAINT fk_9b472dfe6c346e29 FOREIGN KEY (moyen_id) REFERENCES moyen (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_moyen ADD CONSTRAINT fk_d573a081dfbcc46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
