<?php

namespace App\DataFixtures\Tests\PAM;

use App\DataFixtures\Tests\ServicesFixture;
use App\Entity\FonctionAgent;
use App\Entity\FonctionParticuliereAgent;
use App\Entity\PAM\CategoryPamControle;
use App\Entity\PAM\CategoryPamIndicateur;
use App\Entity\PAM\CategoryPamMission;
use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\PamIndicateur;
use App\Entity\PAM\PamMission;
use App\Entity\PAM\PamRapport;
use App\Entity\PAM\PamRapportId;
use App\Entity\Agent;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RapportFixture extends Fixture implements FixtureGroupInterface, DependentFixtureInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager)
    {
        $fonction = new FonctionAgent();
        $fonctionParticuliere = new FonctionParticuliereAgent();

        $fonction->setNom('Commandant');
        $fonctionParticuliere->setNom('Chef');

        $manager->persist($fonction);
        $manager->persist($fonctionParticuliere);

        for($i = 0; $i <= 2; $i++) {
            $this->createRapport($manager, $i+1, $i+1, $fonction, $fonctionParticuliere);
        }

    }

    private function createRapport(ObjectManager $manager, int $keyID, int $month, $fonction, $fonctionParticuliere)
    {
        $currentYear = new \DateTime();

        $rapport = new PamRapport();

        $rapport->setDistance(41)
            ->setNbJoursMer(41)
            ->setEssence(41)
            ->setAdministratif(41)
            ->setPersonnel(41)
            ->setContrPort(41)
            ->setGoMarine(41)
            ->setTechnique(41)
            ->setRepresentation(41)
            ->setNavEff(41)
            ->setMouillage(41)
            ->setMeteo(41)
            ->setMaintenance(41)
            ->setStartDatetime(new \DateTimeImmutable($month . '/01/' . $currentYear->format('Y')))
            ->setEndDatetime(new \DateTimeImmutable($month . '/25/' . $currentYear->format('Y')));

        $catControles = $manager->getRepository(CategoryPamControle::class)->findAll();
        $catIndicateurs = $manager->getRepository(CategoryPamIndicateur::class)->findAll();

        $controle = new PamControle();
        $controle->setPavillon('FR');
        $controle->setNbNavDeroute(2);
        $controle->setCategory($catControles[0]);

        $catMissions = $manager->getRepository(CategoryPamMission::class)->findAll();
        $mission = new PamMission();
        $mission->setCategory($catMissions[0]);
        $mission->setChecked(true);

        for($i = 1; $i <= 10; $i++) {
            $indicateur = new PamIndicateur();
            $indicateur->setPrincipale(10);
            $indicateur->setSecondaire(22);
            $indicateur->setTotal(32);
            $indicateur->setObservations('Test observation');
            $indicateur->setCategory($catIndicateurs[$i]);
            $mission->addIndicateur($indicateur);
        }

        $equipage = new PamEquipage();

        $agent = new Agent();
        $agent->setNom('Colas')
            ->setPrenom('Robert')
            ->setDateArrivee(new \DateTimeImmutable('2020-01-01'));

        $membre = new PamEquipageAgent();

        $membre->setAgent($agent);
        $membre->setFonction($fonction);
        $membre->setFonctionParticuliere($fonctionParticuliere);

        $equipage->addMembre($membre);

        $rapport->setEquipage($equipage);
        $rapport->addControle($controle);
        $rapport->addMission($mission);



        $rapport->setId('MED-' . $currentYear->format('Y') . '-' . $keyID);
        $rapport->setCreatedBy($this->getReference('service'));

        $rapportID = new PamRapportId();

        $rapportID->setId($rapport->getId());

        $manager->persist($rapportID);
        $manager->persist($rapport);
        $manager->flush();
    }

    public function getDependencies() {
        return  [
            ServicesFixture::class,
        ];
    }
}
