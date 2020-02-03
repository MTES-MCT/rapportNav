<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203130812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE suivi_mensuel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE suivi_mensuel (id INT NOT NULL, service_id INT NOT NULL, arret_travail INT NOT NULL, date DATE NOT NULL, conge_annuel INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBCF4663ED5CA9E6 ON suivi_mensuel (service_id)');
        $this->addSql('COMMENT ON COLUMN suivi_mensuel.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE suivi_mensuel ADD CONSTRAINT FK_FBCF4663ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE suivi_mensuel_id_seq CASCADE');
        $this->addSql('DROP TABLE suivi_mensuel');
    }
}
