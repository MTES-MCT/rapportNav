<?php

namespace App\DataFixtures\Tests\PAM;

use App\Entity\PAM\CategoryPamIndicateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IndicateurTypeFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface {

    public static function getGroups(): array {
        return ['test'];
    }

    public function load(ObjectManager $manager) {

        $noms = [
            "Nombre d'heures de mer",
            "Nombre d'opérations suivies (ayant fait l'objet d'un DEFREP)",
            "Nombre de mise en demeure",
            "Nombre de remorquages dans le cadre d'une opération suivie (ayant fait l'objet d'un DEFREP)",
            "Nombre de navires/embarcations interceptés (zone géographique de l’interception en colonne observations)",
            "Nombre de migrants interceptés",
            "Nombre de passeurs présumés",
            "Nombre d'heures de mer (surveillance et lutte)",
            "Nombre de pollutions détectées et/ou constatées par un agent habilité",
            "Nombre de procès-verbaux d'infraction dressés",
            "Nombre de déroutements effectués (accompagnement)",
            "Nombre d'opérations de lutte anti-pollution en mer",
            "Nombre d’heures de mer (surveillance/police des pêches)",
            "dont nombre d'heures en ZEE française",
            "dont nombre d'heures hors ZEE française",
            "Nombre de navires contrôlés en mer (législation pêche)",
            "Nombre de procès-verbaux dressés (législation pêche)",
            "Nombre de navires accompagnés ou déroutés",
            "Nombre d’heures de vol",
            "Nombre d’infractions à la réglementation relative à la protection de l’environnement",
            "Nombre d'heures de mer (y compris VIGIMER )",
            "Nombre d'heures de mer de maintien de l'ordre public en mer",
            "Nombre d’opérations de maintien de l’ordre public en mer",
            "Nombre de contrôles en mer de navires",
            "Nombre total de navires reconnus dans les approches maritimes"
        ];

        foreach($noms as $key => $nom) {
            $type = new CategoryPamIndicateur();
            $type->setId($key+1);
            $type->setNom($nom);
            $manager->persist($type);
        }

        $manager->flush();

    }

    public function getOrder() {
        return 3;
    }
}
