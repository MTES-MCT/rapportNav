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
       $mission1 = new PamMissionType();
       $mission1->setLabel("Assistance aux navires en difficulté et sécurité maritime");

       $mission2 = new PamMissionType();
       $mission2->setLabel("Lutte contre les trafics illicites par voie maritime");

       $manager->persist($mission1);
       $manager->persist($mission2);

       $manager->flush();

    }
}
