<?php

namespace App\Repository;

use App\Entity\RapportNavireControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportNavireControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportNavireControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportNavireControle[]    findAll()
 * @method RapportNavireControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportNavireControleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportNavireControle::class);
    }

    // /**
    //  * @return RapportNavireControle[] Returns an array of RapportNavireControle objects
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
    public function findOneBySomeField($value): ?RapportNavireControle
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
