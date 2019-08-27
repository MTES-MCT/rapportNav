<?php

namespace App\Repository;

use App\Entity\ControleEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ControleEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleEtablissement[]    findAll()
 * @method ControleEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleEtablissementRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, ControleEtablissement::class);
    }
}
