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
}
