<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222162735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_controle ALTER nb_navire_controle DROP NOT NULL');
        $this->addSql('ALTER TABLE pam_controle ALTER nb_pv_peche_sanitaire DROP NOT NULL');
        $this->addSql('ALTER TABLE pam_mission ADD start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_mission ADD end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_controle ALTER nb_navire_controle SET NOT NULL');
        $this->addSql('ALTER TABLE pam_controle ALTER nb_pv_peche_sanitaire SET NOT NULL');
        $this->addSql('ALTER TABLE pam_mission DROP start_datetime');
        $this->addSql('ALTER TABLE pam_mission DROP end_datetime');
    }
}
