<?php

namespace App\DataFixtures\Tests;

use App\Entity\Draft;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DraftsFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {
  public function load(ObjectManager $manager) {
    $draft = new Draft();

    $draft
        ->setData(["test"])
        ->setLastEdit(new \DateTime())
        ->setRapportType('controle_a_bord')
        ->setOwner($this->getReference('service56'));
    $manager->persist($draft);

    $manager->flush();
  }

  public function getDependencies() {
    return array(
        UsersFixture::class,
    );
  }

  public static function getGroups(): array {
    return ['test'];
  }

}
