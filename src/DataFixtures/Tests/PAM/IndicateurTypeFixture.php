<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\PamIndicateurType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class IndicateurTypeFixture extends Fixture implements FixtureGroupInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager) {
        $indic1 = new PamIndicateurType();
        $indic2 = new PamIndicateurType();

        $indic1->setLabel("Nombre d'heures de mer");
        $indic2->setLabel("Nombre de mise en demeure");

        $manager->persist($indic1);
        $manager->persist($indic2);
    }
}
