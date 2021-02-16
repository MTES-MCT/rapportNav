<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216215118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE agent ADD date_arrivee DATE DEFAULT \'2020-01-01\'');
        $this->addSql('ALTER TABLE agent ALTER date_arrivee DROP DEFAULT');
        $this->addSql('ALTER TABLE agent ALTER date_arrivee SET NOT NULL');
        $this->addSql('ALTER TABLE agent ADD date_depart DATE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN agent.date_arrivee IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN agent.date_depart IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE agent DROP matricule');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE agent ADD matricule VARCHAR(12) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE agent ALTER matricule SET NOT NULL');
        $this->addSql('ALTER TABLE agent DROP date_arrivee');
        $this->addSql('ALTER TABLE agent DROP date_depart');
    }
}
