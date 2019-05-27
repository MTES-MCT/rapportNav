<?php

namespace App\Repository;

use App\Entity\RapportPechePied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportPechePied|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportPechePied|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportPechePied[]    findAll()
 * @method RapportPechePied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportPechePiedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportPechePied::class);
    }

    // /**
    //  * @return RapportPechePied[] Returns an array of RapportPechePied objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RapportPechePied
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
