<?php

namespace App\Repository;

use App\Entity\ActiviteLoisir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteLoisir|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteLoisir|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteLoisir[]    findAll()
 * @method ActiviteLoisir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteLoisirRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, ActiviteLoisir::class);
  }

}
