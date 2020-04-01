<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401153725 extends AbstractMigration {
    public function getDescription(): string {
        return 'Rename rapport_navire_controle to categorie_controle_navire';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle DROP CONSTRAINT fk_8e1d464060d5758c');
        $this->addSql('DROP INDEX idx_43dae0eb60d5758c');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle DROP CONSTRAINT fk_b4de4d1a60d5758c');
        $this->addSql('DROP INDEX idx_b4de4d1a60d5758c');
        $this->addSql('ALTER SEQUENCE rapport_navire_controle_id_seq RENAME TO categorie_controle_navire_id_seq');

        $this->addSql('ALTER TABLE rapport_navire_controle RENAME TO categorie_controle_navire');

        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle RENAME TO controle_navire_categorie_controle_navire');
        $this->addSql('ALTER TABLE controle_navire_categorie_controle_navire RENAME COLUMN rapport_navire_controle_id TO categorie_controle_navire_id');
        $this->addSql('CREATE INDEX IDX_A1D265CCDF83C9D5 ON controle_navire_categorie_controle_navire (categorie_controle_navire_id)');
        $this->addSql('ALTER INDEX idx_43dae0eb12dd2dde RENAME TO IDX_A1D265CC12DD2DDE;');
        $this->addSql('ALTER TABLE controle_navire_categorie_controle_navire ADD CONSTRAINT FK_A1D265CCDF83C9D5 FOREIGN KEY (categorie_controle_navire_id) REFERENCES categorie_controle_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle RENAME TO controle_navire_sans_pv_categorie_controle_navire');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_categorie_controle_navire RENAME COLUMN rapport_navire_controle_id TO categorie_controle_navire_id');
        $this->addSql('CREATE INDEX IDX_4129D61DF83C9D5 ON controle_navire_sans_pv_categorie_controle_navire (categorie_controle_navire_id)');
        $this->addSql('ALTER INDEX idx_b4de4d1addfbbdd6 RENAME TO IDX_4129D61DDFBBDD6');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_categorie_controle_navire ADD CONSTRAINT FK_4129D61DF83C9D5 FOREIGN KEY (categorie_controle_navire_id) REFERENCES categorie_controle_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_navire_categorie_controle_navire DROP CONSTRAINT FK_A1D265CCDF83C9D5');
        $this->addSql('DROP INDEX IDX_A1D265CCDF83C9D5');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_categorie_controle_navire DROP CONSTRAINT FK_4129D61DF83C9D5');
        $this->addSql('DROP INDEX IDX_4129D61DF83C9D5');
        $this->addSql('ALTER SEQUENCE categorie_controle_navire_id_seq RENAME TO rapport_navire_controle_id_seq');

        $this->addSql('ALTER TABLE categorie_controle_navire RENAME TO rapport_navire_controle');

        $this->addSql('ALTER TABLE controle_navire_categorie_controle_navire RENAME TO controle_navire_rapport_navire_controle');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle RENAME COLUMN categorie_controle_navire_id TO rapport_navire_controle_id');
        $this->addSql('CREATE INDEX idx_43dae0eb60d5758c ON controle_navire_rapport_navire_controle (rapport_navire_controle_id)');
        $this->addSql('ALTER INDEX IDX_A1D265CC12DD2DDE RENAME TO idx_43dae0eb12dd2dde;');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle ADD CONSTRAINT fk_8e1d464060d5758c FOREIGN KEY (rapport_navire_controle_id) REFERENCES rapport_navire_controle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE controle_navire_sans_pv_categorie_controle_navire RENAME TO controle_navire_sans_pv_rapport_navire_controle');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle RENAME COLUMN categorie_controle_navire_id TO rapport_navire_controle_id');
        $this->addSql('CREATE INDEX idx_b4de4d1a60d5758c ON controle_navire_sans_pv_rapport_navire_controle (rapport_navire_controle_id)');
        $this->addSql('ALTER INDEX IDX_4129D61DDFBBDD6 RENAME TO idx_b4de4d1addfbbdd6');
        $this->addSql('ALTER TABLE controle_navire_sans_pv_rapport_navire_controle ADD CONSTRAINT fk_b4de4d1a60d5758c FOREIGN KEY (rapport_navire_controle_id) REFERENCES rapport_navire_controle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
