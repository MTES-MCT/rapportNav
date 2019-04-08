<?php

namespace App\Repository;

use App\Entity\Navire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Navire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Navire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Navire[]    findAll()
 * @method Navire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Navire::class);
    }

    // /**
    //  * @return Navire[] Returns an array of Navire objects
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
    public function findOneBySomeField($value): ?Navire
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
