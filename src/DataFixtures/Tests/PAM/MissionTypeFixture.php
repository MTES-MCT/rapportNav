<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\CategoryPamMission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MissionTypeFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface {

    public static function getGroups(): array {
        return ['test', 'pam'];
    }

    public function load(ObjectManager $manager) {

        $noms = [
            'Assistance aux navires en difficulté et sécurité maritime',
            'Lutte contre l’immigration illégale par voie maritime',
            "Répression contre les rejets illicites, lutte contre les pollutions et protection de l'environnement",
            "Lutte contre les activités de pêche illégale, gestion du patrimoine marin et des ressources publiques marines",
            "Surveillance et contrôles pour la protection de l’environnement",
            "Sûreté maritime",
            "Souveraineté et protection des intérêts nationaux "
        ];

        foreach($noms as $key => $nom) {
          $type = new CategoryPamMission();
          $type->setNom($nom);
          $type->setId($key+1);
          $manager->persist($type);
       }

       $manager->flush();

    }

    public function getOrder() {
        return 2;
    }
}
