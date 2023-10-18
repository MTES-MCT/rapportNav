<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamPlanning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PamPlanning>
 *
 * @method PamPlanning|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamPlanning|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamPlanning[]    findAll()
 * @method PamPlanning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamPlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamPlanning::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PamPlanning $entity, bool $flush = true): void
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
    public function remove(PamPlanning $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function prochaineMissionADebuter()
    {
        $tomorrow = new \DateTime('now +1days 00:00:00');

        return $this->createQueryBuilder('p')
            ->where('p.dateDebut = :tomorrow')
            ->setParameter('tomorrow', $tomorrow)
            ->getQuery()
            ->getResult();
    }

    public function missionACloturer()
    {
        $tomorrow = new \DateTime('now +1days 00:00:00');

        return $this->createQueryBuilder('p')
            ->where('p.dateFin = :tomorrow')
            ->setParameter('tomorrow', $tomorrow)
            ->getQuery()
            ->getResult();
    }
}
