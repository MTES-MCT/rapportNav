<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325094245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_autre_mission ADD duree_operations_surveillance_trafic INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_navires_operations_surveillance_trafic INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_operations_surveillance_trafic INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_permanence_vigimer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD duree_permanence_vigimer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_navires_permanence_vigimer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_permanence_baaem INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD duree_permanence_baaem INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_autre_mission ADD nb_navires_permanence_baaem INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_autre_mission DROP duree_operations_surveillance_trafic');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_navires_operations_surveillance_trafic');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_operations_surveillance_trafic');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_permanence_vigimer');
        $this->addSql('ALTER TABLE pam_autre_mission DROP duree_permanence_vigimer');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_navires_permanence_vigimer');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_permanence_baaem');
        $this->addSql('ALTER TABLE pam_autre_mission DROP duree_permanence_baaem');
        $this->addSql('ALTER TABLE pam_autre_mission DROP nb_navires_permanence_baaem');
    }
}
