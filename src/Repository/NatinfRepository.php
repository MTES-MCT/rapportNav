<?php

namespace App\Repository;

use App\Entity\Natinf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Natinf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Natinf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Natinf[]    findAll()
 * @method Natinf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatinfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Natinf::class);
    }

    // /**
    //  * @return Natinf[] Returns an array of Natinf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Natinf
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
