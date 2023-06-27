<?php

namespace App\Repository\NavPro;

use App\Entity\NavPro\ControleUnitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ControleUnitaire>
 *
 * @method ControleUnitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleUnitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleUnitaire[]    findAll()
 * @method ControleUnitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleUnitaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControleUnitaire::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ControleUnitaire $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ControleUnitaire $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
