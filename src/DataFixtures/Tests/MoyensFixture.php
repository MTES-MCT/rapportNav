<?php

namespace App\DataFixtures\Tests;

use App\Entity\Moyen;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MoyensFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

  public function load(ObjectManager $manager) {
    $moyen1 = new Moyen();
    $moyen2 = new Moyen();

    $moyen1->setNom('Fiacre')
        ->setServiceProprietaire($this->getReference('service'))
        ->setTerrestre(true)
        ->setDateDebutService(new \DateTime('1830-01-01'))
    ;
    $moyen2->setNom('Souverain')
        ->setServiceProprietaire($this->getReference('service'))
        ->setTerrestre(false)
        ->setDateDebutService(new \DateTime('1819-01-01'))
    ;
    ;
    $manager->persist($moyen1);
    $manager->persist($moyen2);

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
