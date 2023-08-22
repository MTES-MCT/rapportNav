<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809111133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_controle_navire ADD is_gmarmement BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_controle_navire ADD is_gmarmement_sous_item BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_controle_navire ADD is_gmpersonnel BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_controle_navire DROP is_gm');
        $this->addSql('ALTER TABLE categorie_controle_navire DROP is_gmsub_item');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE categorie_controle_navire ADD is_gm BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_controle_navire ADD is_gmsub_item BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_controle_navire DROP is_gmarmement');
        $this->addSql('ALTER TABLE categorie_controle_navire DROP is_gmarmement_sous_item');
        $this->addSql('ALTER TABLE categorie_controle_navire DROP is_gmpersonnel');
    }
}
