<?php

namespace App\Repository;

use App\Entity\ActiviteNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteNavire[]    findAll()
 * @method ActiviteNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ActiviteNavire::class);
    }
}
