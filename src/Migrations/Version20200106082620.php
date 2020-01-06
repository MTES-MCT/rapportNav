<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106082620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_repartition_heures ADD surete INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD maintien_ordre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD nombre_operation_maintien_ordre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_repartition_heures ADD nombre_visite_securite INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_repartition_heures DROP surete');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP maintien_ordre');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP nombre_operation_maintien_ordre');
        $this->addSql('ALTER TABLE rapport_repartition_heures DROP nombre_visite_securite');
    }
}
