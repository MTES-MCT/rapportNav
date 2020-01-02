<?php

namespace App\Repository;

use App\Entity\MissionAutre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionAutre|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionAutre|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionAutre[]    findAll()
 * @method MissionAutre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionAutreRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MissionAutre::class);
    }
}
