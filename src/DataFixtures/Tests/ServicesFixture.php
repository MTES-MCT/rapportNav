<?php

namespace App\DataFixtures\Tests;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ServicesFixture extends Fixture implements FixtureGroupInterface {
  public function load(ObjectManager $manager) {

    $service = new Service();
    $service->setNom('Service');
    $service->setQuadrigramme('TEST');

    $manager->persist($service);
    $this->setReference('service', $service);

    $manager->flush();
  }

  public static function getGroups(): array {
    return ['test'];
  }

}
