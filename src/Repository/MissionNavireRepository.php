<?php

namespace App\Repository;

use App\Entity\MissionNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MissionNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionNavire[]    findAll()
 * @method MissionNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionNavireRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MissionNavire::class);
    }
}
