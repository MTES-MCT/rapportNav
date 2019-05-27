<?php

namespace App\Repository;

use App\Entity\RapportPecheurPied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportPecheurPied|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportPecheurPied|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportPecheurPied[]    findAll()
 * @method RapportPecheurPied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportPecheurPiedRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RapportPecheurPied::class);
    }
}
