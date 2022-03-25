<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322123648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_autre_mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_autre_mission (id INT NOT NULL, nb_assistance_sauvetage INT DEFAULT NULL, duree_assistance_sauvetage INT DEFAULT NULL, nb_manifestations_nautiques INT DEFAULT NULL, duree_manifestations_nautiques INT DEFAULT NULL, nb_lutte_pollution INT DEFAULT NULL, duree_lutte_pollution INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pam_rapport ADD autre_mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_rapport ADD CONSTRAINT FK_A9F2742A617332E9 FOREIGN KEY (autre_mission_id) REFERENCES pam_autre_mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9F2742A617332E9 ON pam_rapport (autre_mission_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_rapport DROP CONSTRAINT FK_A9F2742A617332E9');
        $this->addSql('DROP SEQUENCE pam_autre_mission_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_autre_mission');
        $this->addSql('DROP INDEX UNIQ_A9F2742A617332E9');
        $this->addSql('ALTER TABLE pam_rapport DROP autre_mission_id');
    }
}
