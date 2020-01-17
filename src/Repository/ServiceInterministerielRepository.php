<?php

namespace App\Repository;

use App\Entity\ServiceInterministeriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceInterministeriel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceInterministeriel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceInterministeriel[]    findAll()
 * @method ServiceInterministeriel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceInterministerielRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ServiceInterministeriel::class);
    }
}
