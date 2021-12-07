<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamCheckMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamCheckMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamCheckMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamCheckMission[]    findAll()
 * @method PamCheckMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamCheckMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamCheckMission::class);
    }

    // /**
    //  * @return PamCheckMission[] Returns an array of PamCheckMission objects
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
    public function findOneBySomeField($value): ?PamCheckMission
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
