<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamEquipageAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamEquipageAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamEquipageAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamEquipageAgent[]    findAll()
 * @method PamEquipageAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamEquipageAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamEquipageAgent::class);
    }
}
