<?php

namespace App\Repository;

use App\Entity\Natinf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Natinf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Natinf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Natinf[]    findAll()
 * @method Natinf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatinfRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Natinf::class);
    }
}
