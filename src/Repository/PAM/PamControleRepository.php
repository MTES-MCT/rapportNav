<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamControle[]    findAll()
 * @method PamControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamControleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamControle::class);
    }

    // /**
    //  * @return PamControle[] Returns an array of PamControle objects
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
    public function findOneBySomeField($value): ?PamControle
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
