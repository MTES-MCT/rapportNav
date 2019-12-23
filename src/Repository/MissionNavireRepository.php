<?php

namespace App\Repository;

use App\Entity\MissionNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionNavire[]    findAll()
 * @method MissionNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MissionNavire::class);
    }
}
