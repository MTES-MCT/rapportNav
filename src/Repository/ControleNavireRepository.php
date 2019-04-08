<?php

namespace App\Repository;

use App\Entity\ControleNavire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ControleNavire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleNavire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleNavire[]    findAll()
 * @method ControleNavire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleNavireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ControleNavire::class);
    }

    // /**
    //  * @return ControleNavire[] Returns an array of ControleNavire objects
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
    public function findOneBySomeField($value): ?ControleNavire
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
