<?php

namespace App\Repository;

use App\Entity\ZoneGeographique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZoneGeographique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneGeographique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneGeographique[]    findAll()
 * @method ZoneGeographique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneGeographiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneGeographique::class);
    }

    // /**
    //  * @return ZoneGeographique[] Returns an array of ZoneGeographique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneGeographique
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
