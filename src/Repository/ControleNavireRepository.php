<?php

namespace App\Repository;

use App\Entity\ControleNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControleNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleNavire[]    findAll()
 * @method ControleNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleNavireRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ControleNavire::class);
    }
}
