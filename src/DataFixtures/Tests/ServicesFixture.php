<?php

namespace App\DataFixtures\Tests;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ServicesFixture extends Fixture implements FixtureGroupInterface {
  public function load(ObjectManager $manager) {

    $service35 = new Service();
    $service35->setNom('ULAM 35');
    $service56 = new Service();
    $service56->setNom('ULAM 56');

    $manager->persist($service35);
    $manager->persist($service56);
    $this->setReference('service35', $service35);
    $this->setReference('service56', $service56);

    $manager->flush();
  }

  public static function getGroups(): array {
    return ['default', 'test'];
  }

}
