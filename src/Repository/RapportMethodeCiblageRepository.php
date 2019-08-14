<?php

namespace App\Repository;

use App\Entity\RapportMethodeCiblage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportMethodeCiblage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportMethodeCiblage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportMethodeCiblage[]    findAll()
 * @method RapportMethodeCiblage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportMethodeCiblageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportMethodeCiblage::class);
    }

    // /**
    //  * @return RapportMethodeCiblage[] Returns an array of RapportMethodeCiblage objects
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
    public function findOneBySomeField($value): ?RapportMethodeCiblage
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
