<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\CategoryPamControle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ControleTypeFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface {

    public static function getGroups(): array {
        return ['test', 'pam'];
    }

    public function load(ObjectManager $manager) {
        $noms = [
            'Contrôle en mer de navires  de pêche professionnelle',
            'Contrôle en mer de navires de plaisance professionnelle',
            'Contrôle en mer des navires de plaisance de loisir',
            'Contrôles à terre navires de pêche professionnels',
            'Autres missions',
            'Contrôle à terre de navires de plaisance de loisir',
            'Contrôle à terre de navires de plaisance professionnelle'
        ];

        foreach($noms as $key => $nom) {
            $type = new CategoryPamControle();
            $type->setNom($nom);
            $type->setId($key+1);
            $manager->persist($type);
        }
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }
}
