<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamControle[]    findAll()
 * @method PamControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamControleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamControle::class);
    }
}
