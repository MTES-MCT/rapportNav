<?php

namespace App\Repository;

use App\Entity\CategorieControleNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieControleNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieControleNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieControleNavire[]    findAll()
 * @method CategorieControleNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieControleNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieControleNavire::class);
    }
}
