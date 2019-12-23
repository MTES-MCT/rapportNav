<?php

namespace App\Repository;

use App\Entity\Navire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Navire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Navire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Navire[]    findAll()
 * @method Navire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Navire::class);
    }
}
