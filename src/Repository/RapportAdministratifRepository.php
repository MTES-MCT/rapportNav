<?php

namespace App\Repository;

use App\Entity\RapportAdministratif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportAdministratif|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportAdministratif|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportAdministratif[]    findAll()
 * @method RapportAdministratif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportAdministratifRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportAdministratif::class);
    }

    // /**
    //  * @return RapportAdministratif[] Returns an array of RapportAdministratif objects
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
    public function findOneBySomeField($value): ?RapportAdministratif
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
