<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamAgent[]    findAll()
 * @method PamAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamAgent::class);
    }
}
