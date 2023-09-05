<?php

namespace App\Repository;

use App\Entity\Agent;
use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @method Agent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agent[]    findAll()
 * @method Agent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentRepository extends ServiceEntityRepository
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(ManagerRegistry $registry, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($registry, Agent::class);
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param string|null $fullName
     *
     * @return Agent[]
     */
    public function autocomplete(?string $fullName) : array
    {
        $fullName = strtoupper($fullName);
        /** @var Service $service */
        $service = $this->tokenStorage->getToken()->getUser()->getService();
        $bordeeLiee = $service->getBordeeLiee();
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.service', 's')
            ->where('a.service = :service')
            ->orWhere('a.service = :bordeeliee')
            ->andWhere('a.deletedAt IS NULL')
        ;

        if($fullName) {
            $qb->andWhere("upper(CONCAT(a.prenom, ' ', a.nom)) LIKE :fullName")
                ->setParameters([
                    'service' => $service,
                    'fullName' => '%' . $fullName .'%',
                    'bordeeliee' => $bordeeLiee
                ]);
        } else {
            $qb
                ->setParameter('service', $service)
                ->setParameter(':bordeeliee', $bordeeLiee)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function add(Agent $entity, bool $flush = false)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
