<?php

namespace App\Repository;

use App\Entity\MissionPechePied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionPechePied|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionPechePied|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionPechePied[]    findAll()
 * @method MissionPechePied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionPechePiedRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MissionPechePied::class);
    }
}
