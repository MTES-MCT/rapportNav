<?php

namespace App\Repository;

use App\Entity\MoyenTypeNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MoyenTypeNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyenTypeNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyenTypeNavire[]    findAll()
 * @method MoyenTypeNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenTypeNavireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MoyenTypeNavire::class);
    }

    // /**
    //  * @return MoyenTypeNavire[] Returns an array of MoyenTypeNavire objects
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
    public function findOneBySomeField($value): ?MoyenTypeNavire
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
