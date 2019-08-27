<?php

namespace App\Repository;

use App\Entity\MissionPechePied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MissionPechePied|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionPechePied|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionPechePied[]    findAll()
 * @method MissionPechePied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionPechePiedRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MissionPechePied::class);
    }
}
