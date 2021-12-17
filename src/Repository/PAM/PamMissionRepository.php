<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamMission[]    findAll()
 * @method PamMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamMission::class);
    }

    // /**
    //  * @return PamMission[] Returns an array of PamMission objects
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
    public function findOneBySomeField($value): ?PamMission
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
