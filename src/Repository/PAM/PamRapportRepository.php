<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamRapport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamRapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamRapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamRapport[]    findAll()
 * @method PamRapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamRapportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamRapport::class);
    }

    // /**
    //  * @return PamRapport[] Returns an array of PamRapport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PamRapport
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
