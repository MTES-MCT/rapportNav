<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217174324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categorie_etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie_etablissement (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO categorie_etablissement (id, nom) VALUES 
                                                     (1, \'Marché plaisance : concessionnaire\'),
                                                     (2, \'Culture marine\'),
                                                     (3, \'Site de débarquement\'),
                                                     (4, \'Criée\'), 
                                                     (5, \'Commerce à terre\'), 
                                                     (6, \'Mareyeur\'), 
                                                     (7, \'Contrôle routier\'), 
                                                     (8, \'Formation à la conduite mer et eaux intérieures\'), 
                                                     (9, \'Autre\')');
        $this->addSql('SELECT setval(\'categorie_etablissement_id_seq\', 9, true)');

        $this->addSql('ALTER TABLE etablissement ADD type_id INT DEFAULT NULL');
        $this->addSql('UPDATE etablissement SET type_id = type + 1');
        $this->addSql('ALTER TABLE etablissement DROP type');

        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CC54C8C93 FOREIGN KEY (type_id) REFERENCES categorie_etablissement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_20FD592CC54C8C93 ON etablissement (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE etablissement DROP CONSTRAINT FK_20FD592CC54C8C93');
        $this->addSql('DROP SEQUENCE categorie_etablissement_id_seq CASCADE');
        $this->addSql('DROP TABLE categorie_etablissement');
        $this->addSql('DROP INDEX IDX_20FD592CC54C8C93');
        $this->addSql('ALTER TABLE etablissement ADD type INT NOT NULL');
        $this->addSql('UPDATE etablissement SET type = type_id - 1');
        $this->addSql('ALTER TABLE etablissement DROP type_id');
    }
}
