<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211224154708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE pam_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pam_equipage_agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_agent (id INT NOT NULL, prenom VARCHAR(64) NOT NULL, nom VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pam_equipage_agent (id INT NOT NULL, equipage_id INT NOT NULL, agent_id INT NOT NULL, role VARCHAR(64) NOT NULL, observations VARCHAR(255) DEFAULT NULL, is_absent BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EBC63E18B735E4A0 ON pam_equipage_agent (equipage_id)');
        $this->addSql('CREATE INDEX IDX_EBC63E183414710B ON pam_equipage_agent (agent_id)');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E18B735E4A0 FOREIGN KEY (equipage_id) REFERENCES pam_equipage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_agent ADD CONSTRAINT FK_EBC63E183414710B FOREIGN KEY (agent_id) REFERENCES pam_agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE pam_equipage_pam_membre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_equipage_agent DROP CONSTRAINT FK_EBC63E183414710B');
        $this->addSql('DROP SEQUENCE pam_agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pam_equipage_agent_id_seq CASCADE');
        $this->addSql('CREATE TABLE pam_equipage_pam_membre (pam_equipage_id INT NOT NULL, pam_membre_id INT NOT NULL, PRIMARY KEY(pam_equipage_id, pam_membre_id))');
        $this->addSql('CREATE INDEX idx_1fac574b59b8ff7f ON pam_equipage_pam_membre (pam_membre_id)');
        $this->addSql('CREATE INDEX idx_1fac574b1bdf9d05 ON pam_equipage_pam_membre (pam_equipage_id)');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre ADD CONSTRAINT fk_1fac574b1bdf9d05 FOREIGN KEY (pam_equipage_id) REFERENCES pam_equipage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pam_equipage_pam_membre ADD CONSTRAINT fk_1fac574b59b8ff7f FOREIGN KEY (pam_membre_id) REFERENCES pam_membre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE pam_agent');
        $this->addSql('DROP TABLE pam_equipage_agent');
    }
}
