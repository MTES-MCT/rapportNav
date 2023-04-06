<?php

namespace App\DataFixtures\Tests\PAM;

use App\DataFixtures\Tests\ServicesFixture;
use App\Entity\Agent;
use App\Entity\FonctionAgent;
use App\Entity\PAM\CategoryPamIndicateur;
use App\Entity\PAM\CategoryPamMission;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\PamIndicateur;
use App\Entity\PAM\PamMission;
use App\Request\PAM\DraftRequest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class DraftFixture extends Fixture implements FixtureGroupInterface, DependentFixtureInterface {

    protected $serializer;

    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager)
    {
        $service = $this->getReference('service');
        $draft1 = new PamDraft();
        $draft2 = new PamDraft();
        $current = new \DateTime();

        $body = new DraftRequest();
        $body->setStartDatetime($current);
        $body->setNbJoursMer(14);
        $body->setMouillage(1);

        $agent = new Agent();
        $agent->setNom('Doe');
        $agent->setPrenom('John');
        $agent->setService($service);
        $agent->setDateArrivee(new \DateTimeImmutable());

        $fonction = new FonctionAgent();
        $fonction->setNom('Agent de test');
        $membre = new PamEquipageAgent();
        $membre->setAgent($agent);
        $membre->setFonction($fonction);
        $equipage = new PamEquipage();
        $equipage->addMembre($membre);
        $body->setEquipage($equipage);

        $catMissions = $manager->getRepository(CategoryPamMission::class)->findAll();
        $catIndicateurs = $manager->getRepository(CategoryPamIndicateur::class)->findAll();
        $mission = new PamMission();
        $mission->setCategory($catMissions[0]);
        $mission->setChecked(true);

        for($i = 1; $i <= 10; $i++) {
            $indicateur = new PamIndicateur();
            $indicateur->setPrincipale(44);
            $indicateur->setSecondaire(8);
            $indicateur->setTotal(52);
            $indicateur->setObservations('Test observation');
            $indicateur->setCategory($catIndicateurs[$i]);
            $mission->addIndicateur($indicateur);
        }

        $body->addMission($mission);

        $json = $this->serializer->serialize($body, 'json', ['groups' => 'draft']);

        $draft1->setBody($json);
        $draft1->setNumber('MED-' . $current->format('Y') . '-1');
        $draft1->setStartDatetime($current);
        $draft1->setCreatedBy($service);

        $body->setStartDatetime(new \DateTime('+28 days'));
        $draft2->setBody($json);
        $draft2->setNumber('MED-' . $current->format('Y') . '-4');
        $draft2->setStartDatetime(new \DateTime('+28 days'));
        $draft2->setCreatedBy($service);

        $manager->persist($draft1);
        $manager->persist($draft2);

        $manager->flush();
    }

    public function getDependencies() {
        return [
            ServicesFixture::class,
        ];
    }
}
