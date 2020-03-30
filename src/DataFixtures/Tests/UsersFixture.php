<?php

namespace App\DataFixtures\Tests;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

class UsersFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface {

    /** @var UserManagerInterface */
    private $userManager;

    public function __construct(UserManagerInterface $userManager) {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager) {

        $user56 = $this->userManager->createUser();
        $admin = $this->userManager->createUser();

        $user56->setUsername('ulam35')
            ->setEmail('nope2@email.com')
            ->setPlainPassword('ulam35')
            ->setEnabled(true)
            ->setService($this->getReference("service35"))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user56);

        $admin->setUsername('admin')
            ->setEmail('admin@email.com')
            ->setPlainPassword('admin')
            ->setEnabled(true)
            ->setService(null)
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        $manager->persist($admin);

        $this->setReference('ulam56', $user56);
        $this->setReference('admin', $admin);

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            ServicesFixture::class,
        );
    }


  public static function getGroups(): array {
    return ['test'];
  }
}
