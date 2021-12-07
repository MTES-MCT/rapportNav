<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamIndicateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamIndicateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamIndicateur[]    findAll()
 * @method PamIndicateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamIndicateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamIndicateur::class);
    }

    // /**
    //  * @return PamIndicateur[] Returns an array of PamIndicateur objects
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
    public function findOneBySomeField($value): ?PamIndicateur
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
