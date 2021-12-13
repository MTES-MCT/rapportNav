<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\PamControleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ControleTypeFixture extends Fixture implements FixtureGroupInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager) {
        $controle1 = new PamControleType();
        $controle1->setLabel("Contrôle en mer de navires  de pêche professionnelle");

        $manager->persist($controle1);
        $manager->flush();
    }
}
