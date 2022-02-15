<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateur;
use App\Entity\PAM\PamRapport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamRapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamRapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamRapport[]    findAll()
 * @method PamRapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamRapportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamRapport::class);
    }

    /**
     * @return PamRapport|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLastRapportID(): ?PamRapport
    {
        return $this->createQueryBuilder('r')
            ->select('r.id')
            ->orderBy('r.created_at', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $firstDate
     * @param string $lastDate
     *
     * @return PamIndicateur[]
     */
    public function findByDateRange( $firstDate,  $lastDate)
    {
        return $this->createQueryBuilder('r')
            ->where('r.start_datetime BETWEEN :firstDate AND :lastDate')
            ->setParameter('firstDate', $firstDate)
            ->setParameter('lastDate', $lastDate)
            ->getQuery()
            ->getResult();
    }
}
