<?php

namespace App\Repository;

use App\Entity\Moyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Moyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moyen[]    findAll()
 * @method Moyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Moyen::class);
    }

    // /**
    //  * @return Moyen[] Returns an array of Moyen objects
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
    public function findOneBySomeField($value): ?Moyen
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
