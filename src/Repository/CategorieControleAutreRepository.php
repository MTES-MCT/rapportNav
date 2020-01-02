<?php

namespace App\Repository;

use App\Entity\CategorieControleAutre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieControleAutre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieControleAutre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieControleAutre[]    findAll()
 * @method CategorieControleAutre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieControleAutreRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieControleAutre::class);
    }
}
