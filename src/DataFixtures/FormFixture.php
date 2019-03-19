<?php

namespace App\DataFixtures;

use App\Entity\Form;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FormFixture extends Fixture implements FixtureGroupInterface {
    public function load(ObjectManager $manager) {
        $form = new Form();
        $form->setName("Simple test form")
            ->setActiveVersion($form)
            ->setVersion(1)
            ->setCreation(new \DateTime())
            ->setData(json_decode("{
                        \"title\": \"Test form\",
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
                    }"));

        $manager->persist($form);

        $manager->flush();
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array {
        return ['tests'];
    }
}
