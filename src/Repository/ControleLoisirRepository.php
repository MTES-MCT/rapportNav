<?php

namespace App\Repository;

use App\Entity\ControleLoisir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ControleLoisir|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleLoisir|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleLoisir[]    findAll()
 * @method ControleLoisir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleLoisirRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, ControleLoisir::class);
  }
}
