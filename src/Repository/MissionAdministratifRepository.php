<?php

namespace App\Repository;

use App\Entity\MissionAdministratif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionAdministratif|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionAdministratif|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionAdministratif[]    findAll()
 * @method MissionAdministratif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionAdministratifRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MissionAdministratif::class);
    }
}
