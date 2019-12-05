<?php

namespace App\DataFixtures\Tests;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

class UsersFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

    /** @var UserManagerInterface */
    private $userManager;

    public function __construct(UserManagerInterface $userManager) {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager) {

        $user35 = $this->userManager->createUser();
        $user56 = $this->userManager->createUser();

        $user35->setUsername('ulam35')
            ->setEmail('nope@email.com')
            ->setPlainPassword('ulam35')
            ->setEnabled(true)
            ->setService($this->getReference("service35"))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user35);

        $user56->setUsername('ulam56')
            ->setEmail('nope2@email.com')
            ->setPlainPassword('ulam56')
            ->setEnabled(true)
            ->setService($this->getReference("service56"))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user56);
        $this->setReference('ulam56', $user56);

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            ServicesFixture::class,
        );
    }


  public static function getGroups(): array {
    return ['default', 'test'];
  }
}
