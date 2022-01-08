<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamIndicateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamIndicateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamIndicateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamIndicateur[]    findAll()
 * @method PamIndicateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamIndicateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamIndicateur::class);
    }
}
