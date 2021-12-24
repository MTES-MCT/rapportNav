<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamCheckMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamCheckMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamCheckMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamCheckMission[]    findAll()
 * @method PamCheckMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamCheckMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamCheckMission::class);
    }
}
