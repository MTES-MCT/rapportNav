<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212153012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN rapport.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN rapport.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BE34A09CB03A8386 ON rapport (created_by_id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C896DBBDE ON rapport (updated_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT FK_BE34A09CB03A8386');
        $this->addSql('ALTER TABLE rapport DROP CONSTRAINT FK_BE34A09C896DBBDE');
        $this->addSql('DROP INDEX IDX_BE34A09CB03A8386');
        $this->addSql('DROP INDEX IDX_BE34A09C896DBBDE');
        $this->addSql('ALTER TABLE rapport DROP created_by_id');
        $this->addSql('ALTER TABLE rapport DROP updated_by_id');
        $this->addSql('ALTER TABLE rapport DROP created_at');
        $this->addSql('ALTER TABLE rapport DROP updated_at');
    }
}
