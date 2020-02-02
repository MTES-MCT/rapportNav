<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202224726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE controle_pecheur_pied_sans_pv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE controle_pecheur_pied_sans_pv (id INT NOT NULL, professionnel BOOLEAN NOT NULL, nombre_controle INT DEFAULT NULL, nombre_controle_aire_protegee INT DEFAULT NULL, nombre_controle_chlordecone_totale INT DEFAULT NULL, nombre_controle_chlordecone_partiel INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE mission ADD controle_pro_sans_pv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD controle_plaisance_sans_pv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CD24C3C2E FOREIGN KEY (controle_pro_sans_pv_id) REFERENCES controle_pecheur_pied_sans_pv (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C93EB745F FOREIGN KEY (controle_plaisance_sans_pv_id) REFERENCES controle_pecheur_pied_sans_pv (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9067F23CD24C3C2E ON mission (controle_pro_sans_pv_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C93EB745F ON mission (controle_plaisance_sans_pv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23CD24C3C2E');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C93EB745F');
        $this->addSql('DROP SEQUENCE controle_pecheur_pied_sans_pv_id_seq CASCADE');
        $this->addSql('DROP TABLE controle_pecheur_pied_sans_pv');
        $this->addSql('DROP INDEX IDX_9067F23CD24C3C2E');
        $this->addSql('DROP INDEX IDX_9067F23C93EB745F');
        $this->addSql('ALTER TABLE mission DROP controle_pro_sans_pv_id');
        $this->addSql('ALTER TABLE mission DROP controle_plaisance_sans_pv_id');
    }
}
