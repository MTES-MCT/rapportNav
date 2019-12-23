<?php

namespace App\Repository;

use App\Entity\MoyenTypeNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MoyenTypeNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyenTypeNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyenTypeNavire[]    findAll()
 * @method MoyenTypeNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenTypeNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MoyenTypeNavire::class);
    }
}
