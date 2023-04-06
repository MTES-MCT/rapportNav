<?php

namespace App\DataFixtures\Tests;

use App\Entity\User;
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

        $user = $this->userManager->createUser();
        $admin = $this->userManager->createUser();

        /** @var User $user */
        $user->setUsername('alfred.de-musset')
            ->setEmail('alfred.de-musset@email.com')
            ->setPlainPassword('1234')
            ->setEnabled(true)
            ->setService($this->getReference("service"))
            ->setRoles(['ROLE_USER', 'ROLE_ULAM', 'ROLE_PAM']);
        $manager->persist($user);

        $admin->setUsername('admin')
            ->setEmail('admin@email.com')
            ->setPlainPassword('admin')
            ->setEnabled(true)
            ->setService(null)
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        $manager->persist($admin);

        $this->setReference('user', $user);
        $this->setReference('admin', $admin);

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            ServicesFixture::class,
        );
    }


  public static function getGroups(): array {
    return ['test', 'app'];
  }
}
