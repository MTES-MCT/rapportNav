<?php

namespace App\Repository;

use App\Entity\MissionSecours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MissionSecours|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionSecours|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionSecours[]    findAll()
 * @method MissionSecours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionSecoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MissionSecours::class);
    }

    // /**
    //  * @return MissionSecours[] Returns an array of MissionSecours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MissionSecours
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
