<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\PamMissionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class MissionTypeFixture extends Fixture implements FixtureGroupInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager) {

        $labels = [
            'Assistance aux navires en difficulté et sécurité maritime',
            'Lutte contre l’immigration illégale par voie maritime',
            "Répression contre les rejets illicites, lutte contre les pollutions et protection de l'environnement",
            "Lutte contre les activités de pêche illégale, gestion du patrimoine marin et des ressources publiques marines",
            "Surveillance et contrôles pour la protection de l’environnement",
            "Sûreté maritime",
            "Souveraineté et protection des intérêts nationaux "
        ];

        foreach($labels as $key => $label) {
          $type = new PamMissionType();
          $type->setLabel($label);
          $type->setId($key+1);
          $manager->persist($type);
       }

       $manager->flush();

    }
}
