<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515145218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commandant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commandant (id INT NOT NULL, agent_id INT DEFAULT NULL, service_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FE226A33414710B ON commandant (agent_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FE226A3ED5CA9E6 ON commandant (service_id)');
        $this->addSql('ALTER TABLE commandant ADD CONSTRAINT FK_4FE226A33414710B FOREIGN KEY (agent_id) REFERENCES agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commandant ADD CONSTRAINT FK_4FE226A3ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commandant_id_seq CASCADE');
        $this->addSql('ALTER TABLE commandant DROP CONSTRAINT FK_4FE226A33414710B');
        $this->addSql('ALTER TABLE commandant DROP CONSTRAINT FK_4FE226A3ED5CA9E6');
        $this->addSql('DROP TABLE commandant');
    }
}
