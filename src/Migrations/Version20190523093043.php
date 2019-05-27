<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523093043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire ALTER immatriculation_fr TYPE TEXT');
        $this->addSql('ALTER TABLE navire ALTER immatriculation_fr DROP DEFAULT');
        $this->addSql('ALTER TABLE navire ALTER immatriculation_fr TYPE TEXT');
        $this->addSql('ALTER TABLE navire ALTER longueur_hors_tout DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire ALTER immatriculation_fr TYPE VARCHAR(6)');
        $this->addSql('ALTER TABLE navire ALTER immatriculation_fr DROP DEFAULT');
        $this->addSql('ALTER TABLE navire ALTER longueur_hors_tout SET NOT NULL');
    }
}
