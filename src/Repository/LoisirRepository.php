<?php

namespace App\Repository;

use App\Entity\Loisir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Loisir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loisir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loisir[]    findAll()
 * @method Loisir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoisirRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Loisir::class);
  }
}
