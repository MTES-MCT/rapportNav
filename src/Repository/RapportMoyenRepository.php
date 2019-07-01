<?php

namespace App\Repository;

use App\Entity\RapportMoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportMoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportMoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportMoyen[]    findAll()
 * @method RapportMoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportMoyenRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RapportMoyen::class);
    }
}
