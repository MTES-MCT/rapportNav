<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190827142847 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE rapport_etablissement RENAME TO controle_etablissement');
        $this->addSql('ALTER TABLE rapport_pecheur_pied RENAME TO controle_pecheur_pied');
        $this->addSql('ALTER TABLE rapport_navire RENAME TO controle_navire');

        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf RENAME TO controle_pecheur_pied_natinf');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf RENAME TO controle_etablissement_natinf');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle RENAME TO controle_navire_rapport_navire_controle');
        $this->addSql('ALTER TABLE rapport_navire_natinf RENAME TO controle_navire_natinf');

        $this->addSql('DROP SEQUENCE rapport_pecheur_pied_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_etablissement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rapport_navire_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE controle_pecheur_pied_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controle_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD methode_ciblage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_pecheur_pied ADD CONSTRAINT FK_6DC9D3C554EED909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6DC9D3C554EED909 ON controle_pecheur_pied (methode_ciblage_id)');
        $this->addSql('ALTER INDEX idx_a31f41ae1dfbcc46 RENAME TO IDX_6DC9D3C51DFBCC46');
        $this->addSql('ALTER INDEX idx_a31f41ae9823e004 RENAME TO IDX_6DC9D3C59823E004');
        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf DROP CONSTRAINT fk_4c57f495d1cdc648');
        $this->addSql('DROP INDEX idx_4c57f495d1cdc648');
        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf DROP CONSTRAINT "rapport_pecheur_pied_natinf_pkey"');
        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf RENAME COLUMN rapport_pecheur_pied_id TO controle_pecheur_pied_id');
        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf ADD CONSTRAINT FK_56F480EB9887D3E FOREIGN KEY (controle_pecheur_pied_id) REFERENCES controle_pecheur_pied (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_56F480EB9887D3E ON controle_pecheur_pied_natinf (controle_pecheur_pied_id)');
        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf ADD PRIMARY KEY (controle_pecheur_pied_id, natinf_id)');

        $this->addSql('ALTER INDEX idx_4c57f495f87a39c6 RENAME TO IDX_56F480EF87A39C6');
        $this->addSql('ALTER TABLE controle_etablissement ADD methode_ciblage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_etablissement ADD CONSTRAINT FK_93F103FF54EED909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_93F103FF54EED909 ON controle_etablissement (methode_ciblage_id)');
        $this->addSql('ALTER INDEX idx_495f6dbd1dfbcc46 RENAME TO IDX_93F103FF1DFBCC46');
        $this->addSql('ALTER INDEX idx_495f6dbdff631228 RENAME TO IDX_93F103FFFF631228');
        $this->addSql('ALTER TABLE controle_etablissement_natinf DROP CONSTRAINT fk_8b3e4e9e8040f1b5');
        $this->addSql('DROP INDEX idx_8b3e4e9e8040f1b5');
        $this->addSql('ALTER TABLE controle_etablissement_natinf DROP CONSTRAINT "rapport_etablissement_natinf_pkey"');
        $this->addSql('ALTER TABLE controle_etablissement_natinf RENAME COLUMN rapport_etablissement_id TO controle_etablissement_id');
        $this->addSql('ALTER TABLE controle_etablissement_natinf ADD CONSTRAINT FK_ECAA3CEE394E6007 FOREIGN KEY (controle_etablissement_id) REFERENCES controle_etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ECAA3CEE394E6007 ON controle_etablissement_natinf (controle_etablissement_id)');
        $this->addSql('ALTER TABLE controle_etablissement_natinf ADD PRIMARY KEY (controle_etablissement_id, natinf_id)');
        $this->addSql('ALTER INDEX idx_8b3e4e9ef87a39c6 RENAME TO IDX_ECAA3CEEF87A39C6');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT fk_9067f23c54eed909');
        $this->addSql('DROP INDEX idx_9067f23c54eed909');

        $this->addSql('ALTER TABLE mission DROP methode_ciblage_id');

        $this->addSql('ALTER TABLE controle_navire ADD methode_ciblage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD CONSTRAINT FK_43CC3BA254EED909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_43CC3BA254EED909 ON controle_navire (methode_ciblage_id)');
        $this->addSql('ALTER INDEX idx_6fa6ddf21dfbcc46 RENAME TO IDX_43CC3BA21DFBCC46');
        $this->addSql('ALTER INDEX idx_6fa6ddf2d840fd82 RENAME TO IDX_43CC3BA2D840FD82');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle DROP CONSTRAINT fk_8e1d4640db22df6e');
        $this->addSql('DROP INDEX idx_8e1d4640db22df6e');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle DROP CONSTRAINT "rapport_navire_rapport_navire_controle_pkey"');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle RENAME COLUMN rapport_navire_id TO controle_navire_id');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle ADD CONSTRAINT FK_43DAE0EB12DD2DDE FOREIGN KEY (controle_navire_id) REFERENCES controle_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_43DAE0EB12DD2DDE ON controle_navire_rapport_navire_controle (controle_navire_id)');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle ADD PRIMARY KEY (controle_navire_id, rapport_navire_controle_id)');

        $this->addSql('ALTER INDEX idx_8e1d464060d5758c RENAME TO IDX_43DAE0EB60D5758C');
        $this->addSql('ALTER TABLE controle_navire_natinf DROP CONSTRAINT fk_e3ca9ab5db22df6e');
        $this->addSql('DROP INDEX idx_e3ca9ab5db22df6e');
        $this->addSql('ALTER TABLE controle_navire_natinf DROP CONSTRAINT "rapport_navire_natinf_pkey"');
        $this->addSql('ALTER TABLE controle_navire_natinf RENAME COLUMN rapport_navire_id TO controle_navire_id');
        $this->addSql('ALTER TABLE controle_navire_natinf ADD CONSTRAINT FK_3964F4F712DD2DDE FOREIGN KEY (controle_navire_id) REFERENCES controle_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3964F4F712DD2DDE ON controle_navire_natinf (controle_navire_id)');
        $this->addSql('ALTER TABLE controle_navire_natinf ADD PRIMARY KEY (controle_navire_id, natinf_id)');
        $this->addSql('ALTER INDEX idx_e3ca9ab5f87a39c6 RENAME TO IDX_3964F4F7F87A39C6');

        $this->addSql('ALTER TABLE rapport_methode_ciblage RENAME TO methode_ciblage');
        $this->addSql('DROP SEQUENCE rapport_methode_ciblage_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE methode_ciblage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE methode_ciblage RENAME TO rapport_methode_ciblage');
        $this->addSql('DROP SEQUENCE methode_ciblage_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE rapport_methode_ciblage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('ALTER TABLE controle_etablissement RENAME TO rapport_etablissement');
        $this->addSql('ALTER TABLE controle_pecheur_pied RENAME TO rapport_pecheur_pied');
        $this->addSql('ALTER TABLE controle_navire RENAME TO rapport_navire');

        $this->addSql('ALTER TABLE controle_pecheur_pied_natinf RENAME TO rapport_pecheur_pied_natinf');
        $this->addSql('ALTER TABLE controle_etablissement_natinf RENAME TO rapport_etablissement_natinf');
        $this->addSql('ALTER TABLE controle_navire_rapport_navire_controle RENAME TO rapport_navire_rapport_navire_controle');
        $this->addSql('ALTER TABLE controle_navire_natinf RENAME TO rapport_navire_natinf');

        $this->addSql('DROP SEQUENCE controle_pecheur_pied_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_etablissement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controle_navire_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE rapport_pecheur_pied_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rapport_navire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('ALTER TABLE mission ADD methode_ciblage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT fk_9067f23c54eed909 FOREIGN KEY (methode_ciblage_id) REFERENCES rapport_methode_ciblage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9067f23c54eed909 ON mission (methode_ciblage_id)');
        $this->addSql('ALTER TABLE rapport_etablissement DROP CONSTRAINT FK_93F103FF54EED909');
        $this->addSql('DROP INDEX IDX_93F103FF54EED909');
        $this->addSql('ALTER TABLE rapport_etablissement DROP methode_ciblage_id');
        $this->addSql('ALTER INDEX idx_93f103ff1dfbcc46 RENAME TO idx_495f6dbd1dfbcc46');
        $this->addSql('ALTER INDEX idx_93f103ffff631228 RENAME TO idx_495f6dbdff631228');
        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP CONSTRAINT FK_6DC9D3C554EED909');
        $this->addSql('DROP INDEX IDX_6DC9D3C554EED909');
        $this->addSql('ALTER TABLE rapport_pecheur_pied DROP methode_ciblage_id');
        $this->addSql('ALTER INDEX idx_6dc9d3c59823e004 RENAME TO idx_a31f41ae9823e004');
        $this->addSql('ALTER INDEX idx_6dc9d3c51dfbcc46 RENAME TO idx_a31f41ae1dfbcc46');
        $this->addSql('ALTER TABLE rapport_navire DROP CONSTRAINT FK_43CC3BA254EED909');
        $this->addSql('DROP INDEX IDX_43CC3BA254EED909');
        $this->addSql('ALTER TABLE rapport_navire DROP methode_ciblage_id');
        $this->addSql('ALTER INDEX idx_43cc3ba2d840fd82 RENAME TO idx_6fa6ddf2d840fd82');
        $this->addSql('ALTER INDEX idx_43cc3ba21dfbcc46 RENAME TO idx_6fa6ddf21dfbcc46');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf DROP CONSTRAINT FK_56F480EB9887D3E');
        $this->addSql('DROP INDEX IDX_56F480EB9887D3E');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf DROP CONSTRAINT controle_pecheur_pied_natinf_pkey');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf RENAME COLUMN controle_pecheur_pied_id TO rapport_pecheur_pied_id');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf ADD CONSTRAINT fk_4c57f495d1cdc648 FOREIGN KEY (rapport_pecheur_pied_id) REFERENCES rapport_pecheur_pied (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4c57f495d1cdc648 ON rapport_pecheur_pied_natinf (rapport_pecheur_pied_id)');
        $this->addSql('ALTER TABLE rapport_pecheur_pied_natinf ADD PRIMARY KEY (rapport_pecheur_pied_id, natinf_id)');
        $this->addSql('ALTER INDEX idx_56f480ef87a39c6 RENAME TO idx_4c57f495f87a39c6');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf DROP CONSTRAINT FK_ECAA3CEE394E6007');
        $this->addSql('DROP INDEX IDX_ECAA3CEE394E6007');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf DROP CONSTRAINT controle_etablissement_natinf_pkey');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf RENAME COLUMN controle_etablissement_id TO rapport_etablissement_id');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf ADD CONSTRAINT fk_8b3e4e9e8040f1b5 FOREIGN KEY (rapport_etablissement_id) REFERENCES rapport_etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8b3e4e9e8040f1b5 ON rapport_etablissement_natinf (rapport_etablissement_id)');
        $this->addSql('ALTER TABLE rapport_etablissement_natinf ADD PRIMARY KEY (rapport_etablissement_id, natinf_id)');
        $this->addSql('ALTER INDEX idx_ecaa3ceef87a39c6 RENAME TO idx_8b3e4e9ef87a39c6');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle DROP CONSTRAINT FK_43DAE0EB12DD2DDE');
        $this->addSql('DROP INDEX IDX_43DAE0EB12DD2DDE');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle DROP CONSTRAINT controle_navire_rapport_navire_controle_pkey');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle RENAME COLUMN controle_navire_id TO rapport_navire_id');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle ADD CONSTRAINT fk_8e1d4640db22df6e FOREIGN KEY (rapport_navire_id) REFERENCES rapport_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8e1d4640db22df6e ON rapport_navire_rapport_navire_controle (rapport_navire_id)');
        $this->addSql('ALTER TABLE rapport_navire_rapport_navire_controle ADD PRIMARY KEY (rapport_navire_id, rapport_navire_controle_id)');
        $this->addSql('ALTER INDEX idx_43dae0eb60d5758c RENAME TO idx_8e1d464060d5758c');
        $this->addSql('ALTER TABLE rapport_navire_natinf DROP CONSTRAINT FK_3964F4F712DD2DDE');
        $this->addSql('DROP INDEX IDX_3964F4F712DD2DDE');
        $this->addSql('ALTER TABLE rapport_navire_natinf DROP CONSTRAINT controle_navire_natinf_pkey');
        $this->addSql('ALTER TABLE rapport_navire_natinf RENAME COLUMN controle_navire_id TO rapport_navire_id');
        $this->addSql('ALTER TABLE rapport_navire_natinf ADD CONSTRAINT fk_e3ca9ab5db22df6e FOREIGN KEY (rapport_navire_id) REFERENCES rapport_navire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e3ca9ab5db22df6e ON rapport_navire_natinf (rapport_navire_id)');
        $this->addSql('ALTER TABLE rapport_navire_natinf ADD PRIMARY KEY (rapport_navire_id, natinf_id)');
        $this->addSql('ALTER INDEX idx_3964f4f7f87a39c6 RENAME TO idx_e3ca9ab5f87a39c6');

    }
}
