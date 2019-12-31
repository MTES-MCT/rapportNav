<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191231110200 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE controle_navire_sans_pv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE controle_navire_sans_pv (id INT NOT NULL, nombre_controle INT DEFAULT NULL, nombre_controle_aire_protegee INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE controle_navire_sans_pv_rapport_navire_controle (controle_navire_sans_pv_id INT NOT NULL, rapport_navire_controle_id INT NOT NULL, PRIMARY KEY(controle_navire_sans_pv_id, rapport_navire_controle_id))');
        $this->addSql('CREATE INDEX IDX_B4DE4D1ADDFBBDD6 ON controle_navire_sans_pv_rapport_navire_controle (controle_navire_sans_pv_id)');
        $this->addSql('CREATE INDEX IDX_B4DE4D1A60D5758C ON controle_navire_sans_pv_rapport_navire_controle (rapport_navire_controle_id)');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle ADD CONSTRAINT FK_B4DE4D1ADDFBBDD6 FOREIGN KEY (controle_navire_sans_pv_id) REFERENCES controle_navire_sans_pv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle ADD CONSTRAINT FK_B4DE4D1A60D5758C FOREIGN KEY (rapport_navire_controle_id) REFERENCES rapport_navire_controle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD controle_sans_pv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C1C4482B5 FOREIGN KEY (controle_sans_pv_id) REFERENCES controle_navire_sans_pv (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9067F23C1C4482B5 ON mission (controle_sans_pv_id)');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C1C4482B5');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle DROP CONSTRAINT FK_B4DE4D1ADDFBBDD6');
        $this->addSql('DROP SEQUENCE controle_navire_sans_pv_id_seq CASCADE');
        $this->addSql('DROP TABLE controle_navire_sans_pv');
        $this->addSql('DROP TABLE controle_navire_sans_pv_rapport_navire_controle');
        $this->addSql('DROP INDEX IDX_9067F23C1C4482B5');
        $this->addSql('ALTER TABLE mission DROP controle_sans_pv_id');
    }
}
