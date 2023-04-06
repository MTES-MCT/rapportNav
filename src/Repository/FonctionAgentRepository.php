<?php

namespace App\Repository;

use App\Entity\FonctionAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FonctionAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionAgent[]    findAll()
 * @method FonctionAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FonctionAgent::class);
    }

    public function remove(FonctionAgent $entity, bool $flush = false)
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function add(FonctionAgent $entity, bool $flush = false)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
