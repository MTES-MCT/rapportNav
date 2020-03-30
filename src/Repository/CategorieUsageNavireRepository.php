<?php

namespace App\Repository;

use App\Entity\CategorieUsageNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieUsageNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieUsageNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieUsageNavire[]    findAll()
 * @method CategorieUsageNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieUsageNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieUsageNavire::class);
    }
}
