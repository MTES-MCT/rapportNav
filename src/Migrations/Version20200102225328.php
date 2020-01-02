<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200102225328 extends AbstractMigration {
    public function getDescription(): string {
        return 'Add Autre Contrôle. ';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categorie_controle_autre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_autre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie_controle_autre (id INT NOT NULL, nom TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_autre (id INT NOT NULL, rapport_id INT NOT NULL, controle_id INT NOT NULL, nombre_controle INT NOT NULL, nombre_pv INT NOT NULL, commentaire TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEF275011DFBCC46 ON controle_autre (rapport_id)');
        $this->addSql('CREATE INDEX IDX_DEF27501758926A6 ON controle_autre (controle_id)');
        $this->addSql('CREATE TABLE controle_autre_natinf (controle_autre_id INT NOT NULL, natinf_id INT NOT NULL, PRIMARY KEY(controle_autre_id, natinf_id))');
        $this->addSql('CREATE INDEX IDX_2B4E69866678B15A ON controle_autre_natinf (controle_autre_id)');
        $this->addSql('CREATE INDEX IDX_2B4E6986F87A39C6 ON controle_autre_natinf (natinf_id)');
        $this->addSql('ALTER TABLE controle_autre ADD CONSTRAINT FK_DEF275011DFBCC46 FOREIGN KEY (rapport_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_autre ADD CONSTRAINT FK_DEF27501758926A6 FOREIGN KEY (controle_id) REFERENCES categorie_controle_autre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_autre_natinf ADD CONSTRAINT FK_2B4E69866678B15A FOREIGN KEY (controle_autre_id) REFERENCES controle_autre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_autre_natinf ADD CONSTRAINT FK_2B4E6986F87A39C6 FOREIGN KEY (natinf_id) REFERENCES natinf (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_autre DROP CONSTRAINT FK_DEF27501758926A6');
        $this->addSql('ALTER TABLE controle_autre_natinf DROP CONSTRAINT FK_2B4E69866678B15A');
        $this->addSql('DROP SEQUENCE categorie_controle_autre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_autre_id_seq CASCADE');
        $this->addSql('DROP TABLE categorie_controle_autre');
        $this->addSql('DROP TABLE controle_autre');
        $this->addSql('DROP TABLE controle_autre_natinf');
    }
}
