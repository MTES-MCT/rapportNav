<?php

namespace App\DataFixtures\Tests;

use App\Entity\CategorieUsageNavire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategorieUsageNavireFixture extends Fixture implements FixtureGroupInterface {
    public function load(ObjectManager $manager) {

        $categoriePro = new CategorieUsageNavire();
        $categoriePro->setNom("Navire de pêche professionnelle");
        $manager->persist($categoriePro);
        $this->addReference("catNavPro", $categoriePro);

        // Other categories
        $categories = [
            "Navires conchylicoles",
            "Navires école",
            "Navires de commerce / à passagers",
            "NUC",
            "Navire de plaisance non professionnel",
            "Support plongée (club)",
        ];

        foreach($categories as $dataCat) {
            $categorie = new CategorieUsageNavire();
            $categorie->setNom($dataCat);

            $manager->persist($categorie);
        }

        $manager->flush();
    }

    public static function getGroups(): array {
        return ['test'];
    }
}
