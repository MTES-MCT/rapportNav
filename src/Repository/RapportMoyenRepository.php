<?php

namespace App\Repository;

use App\Entity\RapportMoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RapportMoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportMoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportMoyen[]    findAll()
 * @method RapportMoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportMoyenRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, RapportMoyen::class);
    }
}
