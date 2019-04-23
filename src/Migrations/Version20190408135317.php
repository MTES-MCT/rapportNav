<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408135317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE controle_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE controle_navire (id INT NOT NULL, controle_id INT NOT NULL, navire_id INT NOT NULL, pv BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43CC3BA2758926A6 ON controle_navire (controle_id)');
        $this->addSql('CREATE INDEX IDX_43CC3BA2D840FD82 ON controle_navire (navire_id)');
        $this->addSql('CREATE TABLE navire (id INT NOT NULL, immatriculation_fr VARCHAR(6) NOT NULL, id_nav_floteur INT NOT NULL, nom VARCHAR(45) NOT NULL, longueur_hors_tout DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT FK_43CC3BA2758926A6 FOREIGN KEY (controle_id) REFERENCES controle_peche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT FK_43CC3BA2D840FD82 FOREIGN KEY (navire_id) REFERENCES navire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire DROP CONSTRAINT FK_43CC3BA2D840FD82');
        $this->addSql('DROP SEQUENCE controle_navire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE navire_id_seq CASCADE');
        $this->addSql('DROP TABLE controle_navire');
        $this->addSql('DROP TABLE navire');
    }
}
