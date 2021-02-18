<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216224751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE moyen ADD date_debut_service DATE DEFAULT \'2020-01-01\'');
        $this->addSql('ALTER TABLE moyen ALTER date_debut_service DROP DEFAULT');
        $this->addSql('ALTER TABLE moyen ALTER date_debut_service SET NOT NULL');
        $this->addSql('ALTER TABLE moyen ADD date_fin_service DATE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN moyen.date_debut_service IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN moyen.date_fin_service IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE moyen DROP date_debut_service');
        $this->addSql('ALTER TABLE moyen DROP date_fin_service');
    }
}
