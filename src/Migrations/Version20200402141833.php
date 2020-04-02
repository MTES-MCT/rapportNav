<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402141833 extends AbstractMigration {
    public function getDescription(): string {
        return 'Refacor : change column names for more explicit ones. ';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_pecheur_pied DROP CONSTRAINT fk_a31f41ae1dfbcc46');
        $this->addSql('DROP INDEX idx_6dc9d3c51dfbcc46');
        $this->addSql('ALTER TABLE controle_pecheur_pied RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD CONSTRAINT FK_6DC9D3C59B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6DC9D3C59B0F88B1 ON controle_pecheur_pied (activite_id)');

        $this->addSql('ALTER TABLE controle_etablissement DROP CONSTRAINT fk_495f6dbd1dfbcc46');
        $this->addSql('DROP INDEX idx_93f103ff1dfbcc46');
        $this->addSql('ALTER TABLE controle_etablissement RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_etablissement ADD CONSTRAINT FK_93F103FF9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_93F103FF9B0F88B1 ON controle_etablissement (activite_id)');

        $this->addSql('ALTER TABLE controle_loisir DROP CONSTRAINT fk_821a0bfa1dfbcc46');
        $this->addSql('DROP INDEX idx_821a0bfa1dfbcc46');
        $this->addSql('ALTER TABLE controle_loisir RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_loisir ADD CONSTRAINT FK_821A0BFA9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_821A0BFA9B0F88B1 ON controle_loisir (activite_id)');

        $this->addSql('ALTER TABLE controle_navire DROP CONSTRAINT fk_6fa6ddf21dfbcc46');
        $this->addSql('DROP INDEX idx_43cc3ba21dfbcc46');
        $this->addSql('ALTER TABLE controle_navire RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT FK_43CC3BA29B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_43CC3BA29B0F88B1 ON controle_navire (activite_id)');

        $this->addSql('ALTER TABLE navire RENAME COLUMN immatriculation_fr TO immatriculation');

        $this->addSql('ALTER TABLE controle_tache DROP CONSTRAINT fk_cde2151dfbcc46');
        $this->addSql('DROP INDEX idx_cde2151dfbcc46');
        $this->addSql('ALTER TABLE controle_tache RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_tache ADD CONSTRAINT FK_CDE2159B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CDE2159B0F88B1 ON controle_tache (activite_id)');

        $this->addSql('ALTER TABLE controle_autre DROP CONSTRAINT fk_def275011dfbcc46');
        $this->addSql('DROP INDEX idx_def275011dfbcc46');
        $this->addSql('ALTER TABLE controle_autre RENAME COLUMN rapport_id TO activite_id');
        $this->addSql('ALTER TABLE controle_autre ADD CONSTRAINT FK_DEF275019B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DEF275019B0F88B1 ON controle_autre (activite_id)');

        $this->addSql('ALTER TABLE navire RENAME COLUMN type_usage TO genre_nav');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE navire RENAME COLUMN genre_nav TO type_usage');

        $this->addSql('ALTER TABLE navire RENAME COLUMN immatriculation TO immatriculation_fr');
        $this->addSql('ALTER TABLE controle_etablissement DROP CONSTRAINT FK_93F103FF9B0F88B1');
        $this->addSql('DROP INDEX IDX_93F103FF9B0F88B1');
        $this->addSql('ALTER TABLE controle_etablissement RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_etablissement ADD CONSTRAINT fk_495f6dbd1dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_93f103ff1dfbcc46 ON controle_etablissement (rapport_id)');
        $this->addSql('ALTER TABLE controle_pecheur_pied DROP CONSTRAINT FK_6DC9D3C59B0F88B1');
        $this->addSql('DROP INDEX IDX_6DC9D3C59B0F88B1');
        $this->addSql('ALTER TABLE controle_pecheur_pied RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD CONSTRAINT fk_a31f41ae1dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6dc9d3c51dfbcc46 ON controle_pecheur_pied (rapport_id)');
        $this->addSql('ALTER TABLE controle_loisir DROP CONSTRAINT FK_821A0BFA9B0F88B1');
        $this->addSql('DROP INDEX IDX_821A0BFA9B0F88B1');
        $this->addSql('ALTER TABLE controle_loisir RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_loisir ADD CONSTRAINT fk_821a0bfa1dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_821a0bfa1dfbcc46 ON controle_loisir (rapport_id)');
        $this->addSql('ALTER TABLE controle_navire DROP CONSTRAINT FK_43CC3BA29B0F88B1');
        $this->addSql('DROP INDEX IDX_43CC3BA29B0F88B1');
        $this->addSql('ALTER TABLE controle_navire RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT fk_6fa6ddf21dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_43cc3ba21dfbcc46 ON controle_navire (rapport_id)');
        $this->addSql('ALTER TABLE controle_tache DROP CONSTRAINT FK_CDE2159B0F88B1');
        $this->addSql('DROP INDEX IDX_CDE2159B0F88B1');
        $this->addSql('ALTER TABLE controle_tache RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_tache ADD CONSTRAINT fk_cde2151dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cde2151dfbcc46 ON controle_tache (rapport_id)');
        $this->addSql('ALTER TABLE controle_autre DROP CONSTRAINT FK_DEF275019B0F88B1');
        $this->addSql('DROP INDEX IDX_DEF275019B0F88B1');
        $this->addSql('ALTER TABLE controle_autre RENAME COLUMN activite_id TO rapport_id');
        $this->addSql('ALTER TABLE controle_autre ADD CONSTRAINT fk_def275011dfbcc46 FOREIGN KEY (rapport_id) REFERENCES activite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_def275011dfbcc46 ON controle_autre (rapport_id)');
    }
}
