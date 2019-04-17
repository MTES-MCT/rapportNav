<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416175651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_peche_agent RENAME TO rapport_agent');
        $this->addSql('ALTER TABLE controle_peche_moyen RENAME TO rapport_moyen');
        $this->addSql('ALTER TABLE controle_navire RENAME TO rapport_navire');
        $this->addSql('ALTER TABLE controle_peche RENAME TO rapport');

        $this->addSql('DROP SEQUENCE controle_peche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_navire_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE rapport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE rapport_agent DROP CONSTRAINT fk_90a992b58534a121');
        $this->addSql('DROP INDEX idx_90a992b58534a121');
        $this->addSql('ALTER TABLE rapport_agent DROP CONSTRAINT controle_peche_agent_pkey');
        $this->addSql('ALTER TABLE rapport_agent RENAME COLUMN controle_peche_id TO rapport_id');
        $this->addSql('ALTER TABLE rapport_agent ADD CONSTRAINT FK_6B985431DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B985431DFBCC46 ON rapport_agent (rapport_id)');
        $this->addSql('ALTER TABLE rapport_agent ADD PRIMARY KEY (rapport_id, agent_id)');
        $this->addSql('ALTER INDEX idx_90a992b53414710b RENAME TO IDX_6B985433414710B');
        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT fk_9b472dfe8534a121');
        $this->addSql('DROP INDEX idx_9b472dfe8534a121');
        $this->addSql('ALTER TABLE rapport_moyen DROP CONSTRAINT controle_peche_moyen_pkey');
        $this->addSql('ALTER TABLE rapport_moyen RENAME COLUMN controle_peche_id TO rapport_id');
        $this->addSql('ALTER TABLE rapport_moyen ADD CONSTRAINT FK_D573A081DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D573A081DFBCC46 ON rapport_moyen (rapport_id)');
        $this->addSql('ALTER TABLE rapport_moyen ADD PRIMARY KEY (rapport_id, moyen_id)');
        $this->addSql('ALTER INDEX idx_9b472dfe6c346e29 RENAME TO IDX_D573A086C346E29');
        $this->addSql('ALTER TABLE rapport_navire ALTER pv DROP DEFAULT');
        $this->addSql('ALTER INDEX idx_43cc3ba2758926a6 RENAME TO IDX_6FA6DDF2758926A6');
        $this->addSql('ALTER INDEX idx_43cc3ba2d840fd82 RENAME TO IDX_6FA6DDF2D840FD82');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_agent RENAME TO controle_peche_agent');
        $this->addSql('ALTER TABLE rapport_moyen RENAME TO controle_peche_moyen');
        $this->addSql('ALTER TABLE rapport_navire RENAME TO controle_navire');
        $this->addSql('ALTER TABLE rapport RENAME TO controle_peche');

        $this->addSql('DROP SEQUENCE rapport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_navire_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE controle_peche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE controle_peche_agent DROP CONSTRAINT FK_6B985431DFBCC46');
        $this->addSql('DROP INDEX IDX_6B985431DFBCC46');
        $this->addSql('ALTER TABLE controle_peche_agent DROP CONSTRAINT rapport_agent_pkey');
        $this->addSql('ALTER TABLE controle_peche_agent RENAME COLUMN rapport_id TO controle_peche_id');
        $this->addSql('ALTER TABLE controle_peche_agent ADD CONSTRAINT fk_90a992b58534a121 FOREIGN KEY (controle_peche_id) REFERENCES controle_peche (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_90a992b58534a121 ON controle_peche_agent (controle_peche_id)');
        $this->addSql('ALTER TABLE controle_peche_agent ADD PRIMARY KEY (controle_peche_id, agent_id)');
        $this->addSql('ALTER INDEX idx_6b985433414710b RENAME TO idx_90a992b53414710b');
        $this->addSql('ALTER TABLE controle_peche_moyen DROP CONSTRAINT FK_D573A081DFBCC46');
        $this->addSql('DROP INDEX IDX_D573A081DFBCC46');
        $this->addSql('ALTER TABLE controle_peche_moyen DROP CONSTRAINT rapport_moyen_pkey');
        $this->addSql('ALTER TABLE controle_peche_moyen RENAME COLUMN rapport_id TO controle_peche_id');
        $this->addSql('ALTER TABLE controle_peche_moyen ADD CONSTRAINT fk_9b472dfe8534a121 FOREIGN KEY (controle_peche_id) REFERENCES controle_peche (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9b472dfe8534a121 ON controle_peche_moyen (controle_peche_id)');
        $this->addSql('ALTER TABLE controle_peche_moyen ADD PRIMARY KEY (controle_peche_id, moyen_id)');
        $this->addSql('ALTER INDEX idx_d573a086c346e29 RENAME TO idx_9b472dfe6c346e29');
        $this->addSql('ALTER INDEX idx_6fa6ddf2758926a6 RENAME TO idx_43cc3ba2758926a6');
        $this->addSql('ALTER INDEX idx_6fa6ddf2d840fd82 RENAME TO idx_43cc3ba2d840fd82');

    }
}
