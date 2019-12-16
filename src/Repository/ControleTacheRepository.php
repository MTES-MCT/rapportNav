<?php

namespace App\Repository;

use App\Entity\ControleTache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ControleTache|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleTache|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleTache[]    findAll()
 * @method ControleTache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleTacheRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ControleTache::class);
    }
}
