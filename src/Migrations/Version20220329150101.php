<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329150101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_controle ADD nb_controles_peche_sanitaire INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_controle ADD nb_nav_deroute_env_pollution INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_controle ADD nb_pv_titre_conduite INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD quadrigramme VARCHAR(4) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE service DROP quadrigramme');
        $this->addSql('ALTER TABLE pam_controle DROP nb_controles_peche_sanitaire');
        $this->addSql('ALTER TABLE pam_controle DROP nb_nav_deroute_env_pollution');
        $this->addSql('ALTER TABLE pam_controle DROP nb_pv_titre_conduite');
    }
}
