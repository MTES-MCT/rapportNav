<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamMembre[]    findAll()
 * @method PamMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamMembre::class);
    }
}
