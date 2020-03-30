<?php


namespace App\DataFixtures\Tests;


use App\Entity\ControleNavire;
use App\Entity\MissionNavire;
use App\Entity\Navire;
use App\Entity\Rapport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RapportFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

    public function load(ObjectManager $manager) {
        $rapport = new Rapport();
        $rapport->setDateDebutMission(new \DateTimeImmutable("2020-01-05T08:30"))
            ->setDateFinMission(new \DateTimeImmutable("2020-01-05T16:30"))
            ->setArme(true)
            ->setServiceCreateur($this->getReference("service"))
            ->addAgent($this->getReference("agent1"))
            ->setVersion(1)
        ;
        $missionNavire = new MissionNavire();
        $controleNavire = new ControleNavire();
        $navire = new Navire();

        $navire->setNom("Titanic")
            ->setCategorieUsageNavire($this->getReference("catNavPro"))
            ->setEtranger(false)
            ->setImmatriculationFr("123456")
            ->setPavillon("Français")
        ;
        $controleNavire->setDate(new \DateTimeImmutable("2020-01-05T08:30"))
            ->setNavire($navire)
            ->setPv(false)
            ->setTerrestre(false)
            ;

        $missionNavire->addNavire($controleNavire);
        $rapport->addMission($missionNavire);

        $manager->persist($rapport);
        $this->addReference("rapportNavPro", $rapport);

        $manager->flush();

    }

    public function getDependencies() {
        return array(
            ServicesFixture::class,
            AgentsFixture::class,
            CategorieUsageNavireFixture::class,
        );
    }

    public static function getGroups(): array {
        return ['test'];
    }
}