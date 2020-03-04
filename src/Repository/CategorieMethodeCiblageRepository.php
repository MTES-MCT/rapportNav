<?php

namespace App\Repository;

use App\Entity\CategorieMethodeCiblage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieMethodeCiblage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMethodeCiblage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMethodeCiblage[]    findAll()
 * @method CategorieMethodeCiblage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieMethodeCiblageRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieMethodeCiblage::class);
    }
}
