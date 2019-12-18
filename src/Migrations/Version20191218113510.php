<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218113510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE rapport_repartition_heures_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rapport_repartition_heures (id INT NOT NULL, rapport_id INT NOT NULL, controle_mer INT DEFAULT NULL, controle_terre INT DEFAULT NULL, controle_aire_protegee_mer INT DEFAULT NULL, controle_aire_protegee_terre INT DEFAULT NULL, visite_securite INT DEFAULT NULL, surveillance_manifestation_mer INT DEFAULT NULL, surveillance_manifestation_terre INT DEFAULT NULL, surveillance_dpm_mer INT DEFAULT NULL, surveillance_dpm_terre INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AE5CE4541DFBCC46 ON rapport_repartition_heures (rapport_id)');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD CONSTRAINT FK_AE5CE4541DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE rapport_repartition_heures_id_seq CASCADE');
        $this->addSql('DROP TABLE rapport_repartition_heures');
    }
}
