<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamControleType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamControleType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamControleType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamControleType[]    findAll()
 * @method PamControleType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamControleTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamControleType::class);
    }
}
