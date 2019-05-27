<?php

namespace App\Repository;

use App\Entity\PecheurPied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PecheurPied|null find($id, $lockMode = null, $lockVersion = null)
 * @method PecheurPied|null findOneBy(array $criteria, array $orderBy = null)
 * @method PecheurPied[]    findAll()
 * @method PecheurPied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PecheurPiedRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, PecheurPied::class);
    }
}
