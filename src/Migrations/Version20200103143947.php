<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103143947 extends AbstractMigration {
    public function getDescription(): string {
        return 'Move Coordinates from Mission to appropriate controles, same for terrestre. This migration is NOT fully reversible (Lat/Long coordinates are lost during reverse transform).';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE controle_pecheur_pied ADD terrestre BOOLEAN DEFAULT TRUE');
        $this->addSql('UPDATE controle_pecheur_pied SET terrestre = (select terrestre FROM mission WHERE mission.id = controle_pecheur_pied.rapport_id)');
        $this->addSql('ALTER TABLE controle_pecheur_pied ALTER terrestre DROP DEFAULT');
        $this->addSql('ALTER TABLE controle_pecheur_pied ALTER terrestre SET NOT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD terrestre BOOLEAN DEFAULT TRUE');
        $this->addSql('UPDATE controle_navire SET terrestre = (select terrestre FROM mission WHERE mission.id = controle_navire.rapport_id)');
        $this->addSql('ALTER TABLE controle_navire ALTER terrestre DROP DEFAULT');
        $this->addSql('ALTER TABLE controle_navire ALTER terrestre SET NOT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD lat NUMERIC(10, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_navire ADD long NUMERIC(11, 8) DEFAULT NULL');
        $this->addSql('UPDATE controle_navire SET lat = (SELECT gps_lat FROM mission WHERE mission.id = controle_navire.rapport_id)');
        $this->addSql('UPDATE controle_navire SET long = (SELECT gps_lng FROM mission WHERE mission.id = controle_navire.rapport_id)');
        $this->addSql('ALTER TABLE mission DROP terrestre');
        $this->addSql('ALTER TABLE mission DROP gps_lat');
        $this->addSql('ALTER TABLE mission DROP gps_lng');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE mission ADD terrestre BOOLEAN DEFAULT FALSE');
        $this->addSql('UPDATE mission SET terrestre = (select terrestre FROM controle_navire WHERE mission.id = controle_navire.rapport_id) WHERE mission.discr=\'navire\'');
        $this->addSql('UPDATE mission SET terrestre = (select terrestre FROM controle_pecheur_pied WHERE mission.id = controle_pecheur_pied.rapport_id) WHERE mission.discr=\'pecheapied\'');
        $this->addSql('UPDATE mission SET terrestre = TRUE WHERE mission.discr=\'commerce\'');
        $this->addSql('UPDATE mission SET terrestre = FALSE WHERE mission.discr=\'loisir\'');
        $this->addSql('UPDATE mission SET terrestre = TRUE WHERE mission.discr=\'autre\'');
        $this->addSql('UPDATE mission SET terrestre = FALSE WHERE mission.discr=\'secours\'');
        $this->addSql('UPDATE mission SET terrestre = TRUE WHERE mission.discr=\'administratif\'');
        $this->addSql('UPDATE mission SET terrestre = TRUE WHERE mission.discr=\'formation\'');
        $this->addSql('ALTER TABLE mission ALTER terrestre DROP DEFAULT');
        $this->addSql('ALTER TABLE mission ALTER terrestre SET NOT NULL');

        $this->addSql('ALTER TABLE mission ADD gps_lat NUMERIC(10, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD gps_lng NUMERIC(11, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE controle_pecheur_pied DROP terrestre');
        $this->addSql('ALTER TABLE controle_navire DROP terrestre');
        $this->addSql('ALTER TABLE controle_navire DROP gps_lat');
        $this->addSql('ALTER TABLE controle_navire DROP gps_lng');
    }
}
