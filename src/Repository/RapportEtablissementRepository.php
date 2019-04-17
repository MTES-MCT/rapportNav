<?php

namespace App\Repository;

use App\Entity\RapportEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportEtablissement[]    findAll()
 * @method RapportEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportEtablissementRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RapportEtablissement::class);
    }
}
