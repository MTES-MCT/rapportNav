<?php

namespace App\Repository\PAM\Utils;

use App\Entity\Service;
use App\Exception\BordeeNotFound;
use Doctrine\ORM\QueryBuilder;

class RapportRepositoryUtils {

    /**
     * @param QueryBuilder $qb
     * @param Service      $service
     * @param string|null  $periode
     * @param string|null  $bordee
     *
     * @return QueryBuilder
     * @throws BordeeNotFound
     */
    public function handleRequestFiltre(QueryBuilder $qb, Service $service, ?string $periode, ?string $bordee, ?string $date, ?string $startDate, ?string $endDate): QueryBuilder
    {
        if($periode) {
            switch(true) {
                case $periode === "current":

                    $start = new \DateTime('first day of now');
                    $end = new \DateTime('last day of now');
                    $qb->andWhere('pam_r.start_datetime BETWEEN :start AND :end')
                        ->setParameter('start', $start)
                        ->setParameter('end', $end);
                    break;

                case $periode === '6months':
                    $start = new \DateTime('-6 months');
                    $start = $start->format('Y-m-01');
                    $end = new \DateTime('last day of now');

                    $qb->andWhere('pam_r.start_datetime BETWEEN :first AND :end')
                        ->setParameter('first', $start)
                        ->setParameter('end', $end);
                    break;

                case strpos($periode, 'annee') === 0:
                    $annee = explode('_', $periode)[1];
                    $start = new \DateTime($annee . '-01-01');
                    $end = new \DateTime(((int)$annee + 1) . '-01-01');
                    $qb->andWhere('pam_r.start_datetime BETWEEN :start AND :end')
                        ->setParameter('start', $start)
                        ->setParameter('end', $end);
                    break;

                case $periode === "mois":

                    $start = new \DateTime('first day of ' . $date);
                    $end = new \DateTime('last day of ' . $date);
                    $qb->andWhere('pam_r.start_datetime BETWEEN :start AND :end')
                        ->setParameter('start', $start)
                        ->setParameter('end', $end);
                    break;

            }
        }

        if($startDate && $endDate) {
            $start = new \DateTime('first day of ' . $startDate);
            $end = new \DateTime('last day of ' . $endDate);
            $qb
                ->andWhere('pam_r.start_datetime BETWEEN :start AND :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end);
        }


        if($bordee === 'all') {
            $quadrigramme = $service->getQuadrigramme();
            $qb->leftJoin('pam_r.created_by', 'service')
                ->andWhere('service.quadrigramme = :quadrigramme')
                ->setParameter('quadrigramme', $quadrigramme);
        } else {
            $qb->andWhere('pam_r.created_by = :service')
                ->setParameter('service', $service);
        }

        return $qb;
    }
}
