<?php

namespace App\Repository;

use App\Entity\ControlePecheurPied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControlePecheurPied|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlePecheurPied|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlePecheurPied[]    findAll()
 * @method ControlePecheurPied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlePecheurPiedRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ControlePecheurPied::class);
    }
}
