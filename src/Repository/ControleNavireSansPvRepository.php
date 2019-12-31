<?php

namespace App\Repository;

use App\Entity\ControleNavireSansPv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControleNavireSansPv|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleNavireSansPv|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleNavireSansPv[]    findAll()
 * @method ControleNavireSansPv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleNavireSansPvRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ControleNavireSansPv::class);
    }
}
