<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\Agent;
use App\Entity\PAM\CategoryPamControle;
use App\Entity\PAM\CategoryPamMission;
use App\Entity\PAM\PamAgent;
use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\PamMission;
use App\Entity\PAM\PamRapport;
use App\Entity\PAM\PamRapportId;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RapportFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager) {

        $service = new Service();

        $service->setNom('PAM_test');

        $manager->persist($service);

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
            ->setStartDatetime(new \DateTimeImmutable())
            ->setEndDatetime(new \DateTimeImmutable("+25 days"));

        $catControles = $manager->getRepository(CategoryPamControle::class)->findAll();

        $controle = new PamControle();
        $controle->setPavillon('FR');
        $controle->setNbNavDeroute(2);
        $controle->setCategory($catControles[0]);


        $catMissions = $manager->getRepository(CategoryPamMission::class)->findAll();
        $mission = new PamMission();
        $mission->setCategory($catMissions[0]);
        $mission->setChecked(true);

        $equipage = new PamEquipage();

        $agent = new PamAgent();
        $agent->setNom('Colas');
        $agent->setPrenom('Robert');

        $membre = new PamEquipageAgent();

        $membre->setAgent($agent);
        $membre->setRole('Agent de pont');

        $equipage->addMembre($membre);

        $rapport->setEquipage($equipage);
        $rapport->addControle($controle);
        $rapport->addMission($mission);


        $currentYear = new \DateTime();
        $rapport->setId('MED-' . $currentYear->format('Y') . '-1');
        $rapport->setCreatedBy($service);

        $rapportID = new PamRapportId();

        $rapportID->setId($rapport->getId());

        $manager->persist($rapportID);
        $manager->persist($rapport);
        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }
}
