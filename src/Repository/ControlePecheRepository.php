<?php

namespace App\Repository;

use App\Entity\ControlePeche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ControlePeche|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlePeche|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlePeche[]    findAll()
 * @method ControlePeche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlePecheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ControlePeche::class);
    }
}
