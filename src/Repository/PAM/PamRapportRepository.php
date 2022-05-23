<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateur;
use App\Entity\PAM\PamRapport;
use App\Entity\Service;
use App\Repository\PAM\Utils\RapportRepositoryUtils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @method PamRapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamRapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamRapport[]    findAll()
 * @method PamRapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamRapportRepository extends ServiceEntityRepository
{

    protected $tokenStorage;

    protected $utils;

    public function __construct(ManagerRegistry $registry, TokenStorageInterface $tokenStorage, RapportRepositoryUtils $utils)
    {
        parent::__construct($registry, PamRapport::class);
        $this->tokenStorage = $tokenStorage;
        $this->utils = $utils;
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
     * @param \DateTime $firstDate
     * @param \DateTime $lastDate
     * @param bool      $wholeTeams
     *
     * @return PamRapport[]
     */
    public function findByDateRange(\DateTime $firstDate, \DateTime $lastDate, bool $wholeTeams = true): array
    {
        $preparedDate = new \DateTime('+1 month ' . $lastDate->format('d-m-Y'));
        /** @var Service $service */
        $service = $this->tokenStorage->getToken()->getUser()->getService();
        $qb = $this->createQueryBuilder('r')
            ->where('r.end_datetime BETWEEN :firstDate AND :lastDate')
            ->setParameter('firstDate', $firstDate)
            ->setParameter('lastDate', $preparedDate);

        if($wholeTeams) {
            $quadrigramme = $service->getQuadrigramme();
            $qb->leftJoin('r.created_by', 's')
                ->andWhere('s.quadrigramme = :quadrigramme')
                ->setParameter('quadrigramme', $quadrigramme)
            ;
            return $qb->getQuery()->getResult();
        }

        return $qb->andWhere('r.created_by = :service')
            ->setParameter('service', $service)
            ->getQuery()
            ->getResult();


    }

    /**
     * @param string|null $periode
     * @param string|null $bordee
     *
     * @return array
     */
    public function filter(?string $periode, ?string $bordee, ?string $date, ?string $startDate, ?string $endDate): array
    {
        $qb = $this->createQueryBuilder('pam_r');
        $service = $this->tokenStorage->getToken()->getUser()->getService();
        return $this->utils->handleRequestFiltre($qb, $service, $periode, $bordee, $date, $startDate, $endDate)->getQuery()->getResult();
    }
}
