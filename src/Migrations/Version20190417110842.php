<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417110842 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE etablissement (id INT NOT NULL, type INT NOT NULL, nom VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rapport_etablissement (id INT NOT NULL, rapport_id INT NOT NULL, etablissement_id INT NOT NULL, pv BOOLEAN NOT NULL, natinf VARCHAR(45) DEFAULT NULL, bateaux_controles INT DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_495F6DBD1DFBCC46 ON rapport_etablissement (rapport_id)');
        $this->addSql('CREATE INDEX IDX_495F6DBDFF631228 ON rapport_etablissement (etablissement_id)');
        $this->addSql('ALTER TABLE rapport_etablissement ADD CONSTRAINT FK_495F6DBD1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_etablissement ADD CONSTRAINT FK_495F6DBDFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport ADD discr VARCHAR(255) DEFAULT \'bord\'');
        $this->addSql('ALTER TABLE rapport ALTER discr DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport ALTER  discr SET NOT NULL');
        $this->addSql('ALTER TABLE rapport_navire DROP CONSTRAINT fk_43cc3ba2758926a6');
        $this->addSql('ALTER TABLE rapport RENAME COLUMN type_controle TO type_rapport');
        $this->addSql('DROP INDEX idx_6fa6ddf2758926a6');
        $this->addSql('ALTER TABLE rapport_navire RENAME COLUMN controle_id TO rapport_id');
        $this->addSql('ALTER TABLE rapport_navire ADD CONSTRAINT FK_6FA6DDF21DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6FA6DDF21DFBCC46 ON rapport_navire (rapport_id)');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_etablissement DROP CONSTRAINT FK_495F6DBDFF631228');
        $this->addSql('DROP SEQUENCE etablissement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_etablissement_id_seq CASCADE');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE rapport_etablissement');
        $this->addSql('ALTER TABLE rapport DROP discr');
        $this->addSql('ALTER TABLE rapport_navire DROP CONSTRAINT FK_6FA6DDF21DFBCC46');
        $this->addSql('ALTER TABLE rapport RENAME COLUMN type_rapport TO type_controle');
        $this->addSql('DROP INDEX IDX_6FA6DDF21DFBCC46');
        $this->addSql('ALTER TABLE rapport_navire RENAME COLUMN rapport_id TO controle_id');
        $this->addSql('ALTER TABLE rapport_navire ADD CONSTRAINT fk_43cc3ba2758926a6 FOREIGN KEY (controle_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6fa6ddf2758926a6 ON rapport_navire (controle_id)');
    }
}
