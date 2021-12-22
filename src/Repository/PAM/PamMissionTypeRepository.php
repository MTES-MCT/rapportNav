<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamMissionType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamMissionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamMissionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamMissionType[]    findAll()
 * @method PamMissionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamMissionTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamMissionType::class);
    }

    // /**
    //  * @return PamMissionTypeRequest[] Returns an array of PamMissionTypeRequest objects
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
    public function findOneBySomeField($value): ?PamMissionTypeRequest
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
