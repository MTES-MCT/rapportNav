<?php

namespace App\Repository;

use App\Entity\RapportNavireControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RapportNavireControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportNavireControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportNavireControle[]    findAll()
 * @method RapportNavireControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportNavireControleRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, RapportNavireControle::class);
    }
}
