<?php

namespace App\DataFixtures\Tests;

use App\Entity\Moyen;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

class MoyensFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

  public function load(ObjectManager $manager) {
    $moyen1_35 = new Moyen();
    $moyen2_35 = new Moyen();
    $moyen1_56 = new Moyen();
    $moyen2_56 = new Moyen();

    $moyen1_35->setNom('vehicule1_35')
        ->setServiceProprietaire($this->getReference('service35'))
        ->setTerrestre(true)
    ;
    $moyen2_35->setNom('navire2_35')
        ->setServiceProprietaire($this->getReference('service35'))
        ->setTerrestre(false)
    ;
    $moyen1_56->setNom('vehicule1_56')
        ->setServiceProprietaire($this->getReference('service56'))
        ->setTerrestre(true)
    ;
    $moyen2_56->setNom('vavire2_56')
        ->setServiceProprietaire($this->getReference('service56'))
        ->setTerrestre(false)
    ;
    $manager->persist($moyen1_35);
    $manager->persist($moyen2_35);
    $manager->persist($moyen1_56);
    $manager->persist($moyen2_56);

    $manager->flush();
  }

    public function getDependencies() {
        return array(
            ServicesFixture::class,
        );
    }


  public static function getGroups(): array {
    return ['default'];
  }
}
