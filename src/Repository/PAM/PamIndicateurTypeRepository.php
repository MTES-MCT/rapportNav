<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateurType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamIndicateurType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamIndicateurType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamIndicateurType[]    findAll()
 * @method PamIndicateurType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamIndicateurTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamIndicateurType::class);
    }
}
