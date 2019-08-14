<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190814172936 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE draft RENAME COLUMN owner TO owner_id');
        $this->addSql('UPDATE draft SET owner_id = 0 WHERE owner_id = \'ulam35\'');
        $this->addSql('UPDATE draft SET owner_id = 1 WHERE owner_id = \'ulam56\'');
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner_id SET DATA TYPE INT USING (owner_id::int)');
        //Column was supposed to be already not null, but just to be sure
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner_id DROP DEFAULT');
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner_id SET NOT NULL ');

        $this->addSql('ALTER TABLE draft ADD CONSTRAINT FK_467C96947E3C61F9 FOREIGN KEY (owner_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_467C96947E3C61F9 ON draft (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE draft DROP CONSTRAINT FK_467C96947E3C61F9');
        $this->addSql('DROP INDEX IDX_467C96947E3C61F9');

        $this->addSql('ALTER TABLE draft RENAME COLUMN owner_id TO owner');
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner SET DATA TYPE VARCHAR(45) NOT NULL USING (owner::varchar(45))');
        $this->addSql('UPDATE draft SET owner = \'ulam35\' WHERE owner = \'0\'');
        $this->addSql('UPDATE draft SET owner = \'ulam56\' WHERE owner = \'1\'');
        //Column was supposed to be already not null, but just to be sure
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner DROP DEFAULT');
        $this->addSql('ALTER TABLE draft ALTER COLUMN owner SET NOT NULL ');
    }
}
