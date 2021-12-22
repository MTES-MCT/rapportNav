<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateurType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamIndicateurType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamIndicateurType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamIndicateurType[]    findAll()
 * @method PamIndicateurType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamIndicateurTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamIndicateurType::class);
    }

    // /**
    //  * @return PamIndicateurCategory[] Returns an array of PamIndicateurCategory objects
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
    public function findOneBySomeField($value): ?PamIndicateurCategory
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
