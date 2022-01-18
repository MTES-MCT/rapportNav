<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\PamDraft;
use App\Entity\Service;
use App\Request\PAM\DraftRequest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class DraftFixture extends Fixture implements FixtureGroupInterface {

    protected $serializer;

    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager)
    {
        $draft1 = new PamDraft();
        $draft2 = new PamDraft();
        $current = new \DateTime();
        $service = $manager->getRepository(Service::class)->findOneBy(['nom' => 'PAM_test']);

        $body = new DraftRequest();
        $body->setStartDatetime($current);
        $body->setNbJoursMer(14);
        $body->setMouillage(1);

        $json = $this->serializer->serialize($body, 'json', ['groups' => 'draft']);

        $draft1->setBody($json);
        $draft1->setNumber('MED-' . $current->format('Y') . '-1');
        $draft1->setStartDatetime($current);
        $draft1->setCreatedBy($service);

        $body->setStartDatetime(new \DateTime('+28 days'));
        $draft2->setBody($json);
        $draft2->setNumber('MED-' . $current->format('Y') . '-2');
        $draft2->setStartDatetime(new \DateTime('+28 days'));
        $draft2->setCreatedBy($service);

        $manager->persist($draft1);
        $manager->persist($draft2);

        $manager->flush();
    }
}
