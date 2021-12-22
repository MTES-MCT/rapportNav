<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamEquipage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamEquipage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamEquipage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamEquipage[]    findAll()
 * @method PamEquipage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamEquipageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamEquipage::class);
    }

    // /**
    //  * @return PamEquipage[] Returns an array of PamEquipage objects
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
    public function findOneBySomeField($value): ?PamEquipage
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
