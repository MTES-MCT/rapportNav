<?php

namespace App\Repository;

use App\Entity\RapportRepartitionHeures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RapportRepartitionHeures|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportRepartitionHeures|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportRepartitionHeures[]    findAll()
 * @method RapportRepartitionHeures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportRepartitionHeuresRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, RapportRepartitionHeures::class);
    }
}
