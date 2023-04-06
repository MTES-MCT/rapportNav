<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110092444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT fk_ebc63e183414710b');
        $this->addSql('DROP SEQUENCE pam_agent_id_seq CASCADE');
        $this->addSql('DROP TABLE pam_agent');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT IF EXISTS FK_EBC63E183414710B');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E183414710B FOREIGN KEY (agent_id) REFERENCES agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_agent (id INT NOT NULL, prenom VARCHAR(64) NOT NULL, nom VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT fk_ebc63e183414710b');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT fk_ebc63e183414710b FOREIGN KEY (agent_id) REFERENCES pam_agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
