<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607122923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle_lot_categorie_controle_personnel (controle_lot_id INT NOT NULL, categorie_controle_personnel_id INT NOT NULL, PRIMARY KEY(controle_lot_id, categorie_controle_personnel_id))');
        $this->addSql('CREATE INDEX IDX_967600E3E5EA8E6D ON controle_lot_categorie_controle_personnel (controle_lot_id)');
        $this->addSql('CREATE INDEX IDX_967600E3CCA4C8BA ON controle_lot_categorie_controle_personnel (categorie_controle_personnel_id)');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_personnel ADD CONSTRAINT FK_967600E3E5EA8E6D FOREIGN KEY (controle_lot_id) REFERENCES controle_lot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_personnel ADD CONSTRAINT FK_967600E3CCA4C8BA FOREIGN KEY (categorie_controle_personnel_id) REFERENCES categorie_controle_personnel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_personnel DROP CONSTRAINT FK_967600E3E5EA8E6D');
        $this->addSql('ALTER TABLE controle_lot_categorie_controle_personnel DROP CONSTRAINT FK_967600E3CCA4C8BA');
        $this->addSql('DROP TABLE controle_lot_categorie_controle_personnel');
    }
}
