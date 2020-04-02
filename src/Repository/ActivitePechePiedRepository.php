<?php

namespace App\Repository;

use App\Entity\ActivitePechePied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActivitePechePied|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivitePechePied|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivitePechePied[]    findAll()
 * @method ActivitePechePied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitePechePiedRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ActivitePechePied::class);
    }
}
