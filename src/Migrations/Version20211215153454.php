<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215153454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_indicateur_type ADD number INT NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date DROP NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date DROP NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time DROP NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_indicateur_type DROP number');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date TYPE DATE');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_date SET NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date TYPE DATE');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_date SET NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time TYPE TIME(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER start_time SET NOT NULL');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time TYPE TIME(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time DROP DEFAULT');
        $this->addSql('ALTER TABLE pam_rapport ALTER end_time SET NOT NULL');
    }
}
