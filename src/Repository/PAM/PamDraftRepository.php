<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamDraft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamDraft|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamDraft|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamDraft[]    findAll()
 * @method PamDraft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamDraftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamDraft::class);
    }

    // /**
    //  * @return PamDraft[] Returns an array of PamDraft objects
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
    public function findOneBySomeField($value): ?PamDraft
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
