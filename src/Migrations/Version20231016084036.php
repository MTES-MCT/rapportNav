<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016084036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE pam_date_planning_id_seq CASCADE');
        $this->addSql('CREATE TABLE pam_planning (id INT NOT NULL, service_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F68C6F9BED5CA9E6 ON pam_planning (service_id)');
        $this->addSql('ALTER TABLE pam_planning ADD CONSTRAINT FK_F68C6F9BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE pam_date_planning_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pam_date_planning (id INT NOT NULL, planning_id INT NOT NULL, debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ed05fb8e3d865311 ON pam_date_planning (planning_id)');
        $this->addSql('ALTER TABLE pam_planning DROP CONSTRAINT FK_F68C6F9BED5CA9E6');
        $this->addSql('DROP TABLE pam_planning');
    }
}
