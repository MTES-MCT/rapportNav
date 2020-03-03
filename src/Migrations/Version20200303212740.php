<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303212740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE moyen_type_navire_id_seq CASCADE');
        $this->addSql('ALTER TABLE moyen_type_navire RENAME TO categorie_moyen;');
        $this->addSql('CREATE SEQUENCE categorie_moyen_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE categorie_moyen_id_seq CASCADE');
        $this->addSql('ALTER TABLE categorie_moyen RENAME TO moyen_type_navire');
        $this->addSql('CREATE SEQUENCE moyen_type_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
    }
}
