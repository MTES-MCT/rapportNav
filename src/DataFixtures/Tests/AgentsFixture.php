<?php

namespace App\DataFixtures\Tests;

use App\Entity\Agent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AgentsFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

  public function load(ObjectManager $manager) {
    $agent1_35 = new Agent();
    $agent2_35 = new Agent();
    $agent1_56 = new Agent();
    $agent2_56 = new Agent();

    $agent1_35->setNom("agent1_35")
        ->setPrenom("Alfred")
        ->setMatricule(0)
        ->setService($this->getReference('service35'))
    ;
    $agent2_35->setNom("agent2_35")
        ->setPrenom("Alfonse")
        ->setMatricule(0)
        ->setService($this->getReference('service35'))
    ;
    $agent1_56->setNom("agent1_56")
        ->setPrenom("Anna Laetitia")
        ->setMatricule(0)
        ->setService($this->getReference('service56'))
    ;
    $agent2_56->setNom("agent2_56")
        ->setPrenom("George (Amandine)")
        ->setMatricule(0)
        ->setService($this->getReference('service56'))
    ;

    $manager->persist($agent1_35);
    $this->addReference("agent1_35", $agent1_35);
    $manager->persist($agent2_35);
    $manager->persist($agent1_56);
    $manager->persist($agent2_56);

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
