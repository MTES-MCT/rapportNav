<?php

namespace App\Repository;

use App\Entity\RapportFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportFormation[]    findAll()
 * @method RapportFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportFormationRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RapportFormation::class);
    }
}
