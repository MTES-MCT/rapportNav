<?php

namespace App\Repository;

use App\Entity\PecheurPied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PecheurPied|null find($id, $lockMode = null, $lockVersion = null)
 * @method PecheurPied|null findOneBy(array $criteria, array $orderBy = null)
 * @method PecheurPied[]    findAll()
 * @method PecheurPied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PecheurPiedRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, PecheurPied::class);
    }
}
