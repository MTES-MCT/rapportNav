<?php

namespace App\Repository;

use App\Entity\ActiviteCommerce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteCommerce|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteCommerce|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteCommerce[]    findAll()
 * @method ActiviteCommerce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteCommerceRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ActiviteCommerce::class);
    }
}
