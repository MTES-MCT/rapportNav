<?php

namespace App\Repository;

use App\Entity\Agent;
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
        $service = $this->tokenStorage->getToken()->getUser()->getService();
        $qb = $this->createQueryBuilder('a')
            ->where('a.service = :service');

        if($fullName) {
            $qb->andWhere('upper(a.prenom) LIKE :prenom')
                ->orWhere('upper(a.nom) LIKE :nom')
                ->setParameters([
                    'service' => $service,
                    'prenom' => $fullName .'%',
                    'nom' => $fullName .'%'
                ]);
        } else {
            $qb
            ->setParameter('service', $service);
        }

        return $qb->getQuery()->getResult();
    }
}
