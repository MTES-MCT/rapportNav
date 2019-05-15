<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424163121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport ALTER zone_mission TYPE SMALLINT USING zone_mission::smallint');
        $this->addSql('ALTER TABLE rapport ALTER zone_mission DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport ALTER zone_mission DROP NOT NULL');
        $this->addSql('ALTER TABLE rapport ALTER zone_mission TYPE SMALLINT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport ALTER zone_mission TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE rapport ALTER zone_mission DROP DEFAULT');
        $this->addSql('ALTER TABLE rapport ALTER zone_mission SET NOT NULL');
    }
}
