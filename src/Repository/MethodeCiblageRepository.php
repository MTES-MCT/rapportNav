<?php

namespace App\Repository;

use App\Entity\MethodeCiblage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MethodeCiblage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodeCiblage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodeCiblage[]    findAll()
 * @method MethodeCiblage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodeCiblageRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MethodeCiblage::class);
    }
}
