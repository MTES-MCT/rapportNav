<?php

namespace App\DataFixtures\Tests;

use App\Entity\CategorieControleNavire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategorieControleNavireFixture extends Fixture implements FixtureGroupInterface {
    public function load(ObjectManager $manager) {

        $categoriePro = new CategorieControleNavire();
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
            $categorie = new CategorieControleNavire();
            $categorie->setNom($dataCat);

            $manager->persist($categorie);
        }

        $manager->flush();
    }

    public static function getGroups(): array {
        return ['test'];
    }
}
