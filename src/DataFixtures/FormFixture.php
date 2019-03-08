<?php

namespace App\DataFixtures;

use App\Entity\Form;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FormFixture extends Fixture {
    public function load(ObjectManager $manager) {
        $form = new Form();
        $form->setName("Simple test form")
            ->setActiveVersion($form)
            ->setVersion(1)
            ->setCreation(new \DateTime())
            ->setData("{
    \"title\": \"Rapportage mission\",
    \"pages\": [
        {
            \"name\": \"page1\",
            \"elements\": [
                {
                    \"type\": \"panel\",
                    \"name\": \"panel1\",
                    \"elements\": [
                        {
                            \"type\": \"text\",
                            \"inputType\": \"date\",
                            \"name\": \"question1\",
                            \"title\": \"Date\"
                        }
                    ]
                }
            ]
        }
    ]
}");

        $manager->persist($form);

        $manager->flush();
    }
}
