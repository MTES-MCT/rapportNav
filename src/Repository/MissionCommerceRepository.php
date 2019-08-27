<?php

namespace App\Repository;

use App\Entity\MissionCommerce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MissionCommerce|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionCommerce|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionCommerce[]    findAll()
 * @method MissionCommerce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionCommerceRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MissionCommerce::class);
    }
}
