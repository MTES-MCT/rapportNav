<?php

namespace App\Repository;

use App\Entity\ActiviteAutre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteAutre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteAutre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteAutre[]    findAll()
 * @method ActiviteAutre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteAutreRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ActiviteAutre::class);
    }
}
