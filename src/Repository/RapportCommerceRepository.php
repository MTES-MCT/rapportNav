<?php

namespace App\Repository;

use App\Entity\RapportCommerce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportCommerce|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportCommerce|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportCommerce[]    findAll()
 * @method RapportCommerce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportCommerceRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, RapportCommerce::class);
    }
}
