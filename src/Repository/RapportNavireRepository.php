<?php

namespace App\Repository;

use App\Entity\RapportNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportNavire[]    findAll()
 * @method RapportNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportNavireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportNavire::class);
    }

    // /**
    //  * @return RapportNavire[] Returns an array of RapportNavire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RapportNavire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
