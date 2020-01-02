<?php

namespace App\Repository;

use App\Entity\ControleAutre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControleAutre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleAutre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleAutre[]    findAll()
 * @method ControleAutre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleAutreRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ControleAutre::class);
    }
}
