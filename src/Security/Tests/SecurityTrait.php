<?php

namespace App\Security\Tests;

use App\Entity\Service;
use App\Entity\User;
use App\Security\TokenStorageDecorator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait SecurityTrait
{
    protected static $users = [];

    protected function login(string $role = 'ROLE_USER', bool $userFromDatabase = false): User
    {
        $user = $this->getUser($role, $userFromDatabase);

        $tokenStorage = self::$container->get(TokenStorageInterface::class);

        if ($tokenStorage instanceof TokenStorageDecorator) {
            $tokenStorage->setUser($user);
        } else {
            $tokenStorage->setToken(
                TokenStorageDecorator::getNewToken($user)
            );
        }

        return$tokenStorage->getToken()->getUser();
    }

    public function logout()
    {
        $tokenStorage = self::$container->get(TokenStorageInterface::class);

        $tokenStorage->setToken(null);
    }

    protected function getUser(string $role = 'ROLE_USER', bool $userFromDatabase = false): User {
        if (empty(self::$users[$role])) {
            self::$users[$role] = $userFromDatabase
                ? ($this->getFirstUserByRole($role) ?: $this->createNewUser($role, $userFromDatabase))
                : $this->createNewUser($role, $userFromDatabase);
        }

        return self::$users[$role];
    }

    protected function getFirstUserByRole(string $role = 'ROLE_USER'): ?User
    {
        $entityManager = self::$container->get(EntityManagerInterface::class);

        return $entityManager->getRepository(User::class)
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter(':role', '%'.$role.'%')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    protected function createNewUser(string $role = 'ROLE_USER', bool $persist = false): User
    {
        $entityManager = self::$container->get(EntityManagerInterface::class);
        $service = $entityManager->getRepository(Service::class)->findOneBy(['nom' => 'Service']);
        $user = (new User())
            ->setRoles([$role])
            ->setUsername('test_pam_user')
            ->setEmail('test_pam@email.com')
            ->setPassword('test')
            ->setService($service);

        if ($persist) {
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $user;
    }
}
