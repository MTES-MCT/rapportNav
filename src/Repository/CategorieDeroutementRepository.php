<?php

namespace App\Repository;

use App\Entity\CategorieDeroutement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieDeroutement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieDeroutement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieDeroutement[]    findAll()
 * @method CategorieDeroutement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieDeroutementRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieDeroutement::class);
    }
}
