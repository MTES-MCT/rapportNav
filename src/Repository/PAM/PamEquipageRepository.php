<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamEquipage;
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
     * @return PamEquipage|null
     * @throws NonUniqueResultException
     */
    public function findLastEquipage() : ?PamEquipage
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
