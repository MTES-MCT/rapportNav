<?php

namespace App\Repository;

use App\Entity\ActiviteFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteFormation[]    findAll()
 * @method ActiviteFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteFormationRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ActiviteFormation::class);
    }
}
