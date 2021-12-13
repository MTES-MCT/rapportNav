<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208084655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE pam_draft DROP CONSTRAINT fk_9d0c81d01dfbcc46');
        $this->addSql('DROP INDEX uniq_9d0c81d01dfbcc46');
        $this->addSql('ALTER TABLE pam_draft DROP rapport_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pam_draft ADD rapport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pam_draft ADD CONSTRAINT fk_9d0c81d01dfbcc46 FOREIGN KEY (rapport_id) REFERENCES pam_rapport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_9d0c81d01dfbcc46 ON pam_draft (rapport_id)');
    }
}
