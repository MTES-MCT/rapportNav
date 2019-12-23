<?php

namespace App\Repository;

use App\Entity\MissionFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionFormation[]    findAll()
 * @method MissionFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionFormationRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MissionFormation::class);
    }
}
