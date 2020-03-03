<?php

namespace App\Repository;

use App\Entity\CategorieMoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieMoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMoyen[]    findAll()
 * @method CategorieMoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieMoyenRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, CategorieMoyen::class);
    }
}
