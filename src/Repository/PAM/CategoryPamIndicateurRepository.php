<?php

namespace App\Repository\PAM;

use App\Entity\PAM\CategoryPamIndicateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryPamIndicateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPamIndicateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPamIndicateur[]    findAll()
 * @method CategoryPamIndicateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPamIndicateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPamIndicateur::class);
    }
}
