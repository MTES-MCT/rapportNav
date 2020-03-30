<?php

namespace App\DataFixtures\Tests;

use App\Entity\Agent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AgentsFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

  public function load(ObjectManager $manager) {
    $agent1 = new Agent();
    $agent2 = new Agent();

    $agent1->setNom("De Musset")
        ->setPrenom("Alfred")
        ->setMatricule(0)
        ->setService($this->getReference('service'))
    ;
    $agent2->setNom("Desbordes-Valmore")
        ->setPrenom("Marceline")
        ->setMatricule(0)
        ->setService($this->getReference('service'))
    ;

    $manager->persist($agent1);
    $this->addReference("agent1", $agent1);
    $manager->persist($agent2);

    $manager->flush();
  }

  public function getDependencies() {
    return array(
        ServicesFixture::class,
    );
  }

  public static function getGroups(): array {
    return ['test'];
  }
}
