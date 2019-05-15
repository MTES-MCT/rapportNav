<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515094215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire ADD is_erreur BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE navire ALTER is_erreur SET NOT NULL');
        $this->addSql('ALTER TABLE navire ALTER is_erreur DROP DEFAULT ');
        $this->addSql('ALTER TABLE navire ADD erreur_texte TEXT');
        $this->addSql('ALTER TABLE navire ALTER type_usage TYPE VARCHAR(45)');
        $this->addSql('ALTER TABLE navire ALTER type_usage DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire DROP is_erreur');
        $this->addSql('ALTER TABLE navire DROP erreur_texte');
        $this->addSql('ALTER TABLE navire ALTER type_usage TYPE INT');
    }
}
