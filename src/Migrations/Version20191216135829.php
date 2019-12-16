<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216135829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tache (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_tache (id INT NOT NULL, rapport_id INT NOT NULL, tache_id INT NOT NULL, duree_tache INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CDE2151DFBCC46 ON controle_tache (rapport_id)');
        $this->addSql('CREATE INDEX IDX_CDE215D2235D39 ON controle_tache (tache_id)');
        $this->addSql('ALTER TABLE controle_tache ADD CONSTRAINT FK_CDE2151DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_tache ADD CONSTRAINT FK_CDE215D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission DROP activite');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_tache DROP CONSTRAINT FK_CDE215D2235D39');
        $this->addSql('DROP SEQUENCE tache_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_tache_id_seq CASCADE');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE controle_tache');
        $this->addSql('ALTER TABLE mission ADD activite TEXT DEFAULT NULL');
    }
}
