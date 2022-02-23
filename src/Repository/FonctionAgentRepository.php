<?php

namespace App\Repository;

use App\Entity\FonctionAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FonctionAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionAgent[]    findAll()
 * @method FonctionAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FonctionAgent::class);
    }

    // /**
    //  * @return FonctionAgent[] Returns an array of FonctionAgent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FonctionAgent
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
