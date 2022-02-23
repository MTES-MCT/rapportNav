<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222024418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE fonction_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fonction_particuliere_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fonction_agent (id INT NOT NULL, nom VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fonction_particuliere_agent (id INT NOT NULL, nom VARCHAR(124) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD fonction_particuliere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD fonction_id INT NOT NULL');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP role');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP fonction_particuliere');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E18EC0572DB FOREIGN KEY (fonction_particuliere_id) REFERENCES fonction_particuliere_agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E1857889920 FOREIGN KEY (fonction_id) REFERENCES fonction_agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EBC63E18EC0572DB ON pam_equipage_agent (fonction_particuliere_id)');
        $this->addSql('CREATE INDEX IDX_EBC63E1857889920 ON pam_equipage_agent (fonction_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT FK_EBC63E1857889920');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT FK_EBC63E18EC0572DB');
        $this->addSql('DROP SEQUENCE fonction_agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fonction_particuliere_agent_id_seq CASCADE');
        $this->addSql('DROP TABLE fonction_agent');
        $this->addSql('DROP TABLE fonction_particuliere_agent');
        $this->addSql('DROP INDEX IDX_EBC63E18EC0572DB');
        $this->addSql('DROP INDEX IDX_EBC63E1857889920');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD role VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD fonction_particuliere VARCHAR(124) DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP fonction_particuliere_id');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP fonction_id');
    }
}
