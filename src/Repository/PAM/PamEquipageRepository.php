<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamEquipage;
use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
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

    /**
     * @param Service $service
     *
     * @return PamEquipage|null
     * @throws NonUniqueResultException
     */
    public function findLastEquipage(Service $service) : ?PamEquipage
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.rapport', 'r')
            ->where('r.created_by = :service')
            ->setParameter('service', $service)
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
