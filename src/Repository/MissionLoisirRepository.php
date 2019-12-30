<?php

namespace App\Repository;

use App\Entity\MissionLoisir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionLoisir|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionLoisir|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionLoisir[]    findAll()
 * @method MissionLoisir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionLoisirRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, MissionLoisir::class);
  }

}
