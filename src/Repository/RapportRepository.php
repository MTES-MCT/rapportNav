<?php

namespace App\Repository;

use App\Entity\Rapport;
use App\Entity\Service;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rapport[]    findAll()
 * @method Rapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Rapport::class);
    }

    /**
     * Selects all reports from
     *
     * @param DateTimeInterface $periodStart    Starting date for period
     * @param DateTimeInterface|null $periodEnd End date for period, if null or not specified all reports from starting date will be fetched
     * @param Service|null           $service   Selects report from this specific service
     * @param int|null          $limit          limits the number of reports fetched
     *
     * @return array
     */
    public function findByPeriod(DateTimeInterface $periodStart, DateTimeInterface $periodEnd = null, Service $service = null, int $limit = null): array {
        $em = $this->getEntityManager();

        $params = [
            'periodStart' => $periodStart,
        ];

        $dql = 'SELECT r
            FROM App\Entity\Rapport r
            WHERE r.dateDebutMission >= :periodStart'
        ;

        if(null !== $periodEnd) {
            $dql .= ' AND r.dateDebutMission < :periodEnd';
            $params['periodEnd'] = $periodEnd;
        }

        if(null !== $service) {
            $dql .= ' AND r.serviceCreateur = :service';
            $params['service'] = $service;
        }

        $dql .= ' ORDER BY r.dateDebutMission DESC';

        $query = $em->createQuery($dql)->setParameters($params);

        if(null !== $limit) {
            $query->setMaxResults($limit);
        }

        // returns an array of Product objects
        return $query->getResult();
    }
}
