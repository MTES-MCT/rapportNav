<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamMission[]    findAll()
 * @method PamMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamMission::class);
    }
}
