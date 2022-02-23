<?php

namespace App\Repository;

use App\Entity\FonctionParticuliereAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FonctionParticuliereAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionParticuliereAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionParticuliereAgent[]    findAll()
 * @method FonctionParticuliereAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionParticuliereAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FonctionParticuliereAgent::class);
    }
}
