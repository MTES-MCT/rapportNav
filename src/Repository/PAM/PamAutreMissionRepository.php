<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamAutreMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamAutreMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamAutreMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamAutreMission[]    findAll()
 * @method PamAutreMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamAutreMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamAutreMission::class);
    }
}
