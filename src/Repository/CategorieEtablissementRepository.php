<?php

namespace App\Repository;

use App\Entity\CategorieEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieEtablissement[]    findAll()
 * @method CategorieEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieEtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieEtablissement::class);
    }

    // /**
    //  * @return CategorieEtablissement[] Returns an array of CategorieEtablissement objects
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
    public function findOneBySomeField($value): ?CategorieEtablissement
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
