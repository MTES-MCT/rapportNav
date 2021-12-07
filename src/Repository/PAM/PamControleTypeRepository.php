<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamControleType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamControleType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamControleType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamControleType[]    findAll()
 * @method PamControleType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamControleTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamControleType::class);
    }

    // /**
    //  * @return PamControleType[] Returns an array of PamControleType objects
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
    public function findOneBySomeField($value): ?PamControleType
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