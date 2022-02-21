<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamIndicateur;
use App\Entity\PAM\PamRapport;
use App\Request\PAM\DraftRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @method PamDraft|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamDraft|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamDraft[]    findAll()
 * @method PamDraft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamDraftRepository extends ServiceEntityRepository
{
    protected $serializer;

    protected $tokenStorage;

    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer, TokenStorageInterface $tokenStorage)
    {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
        parent::__construct($registry, PamDraft::class);
    }

    /**
     * @param string $rapportID
     *
     * @return PamIndicateur[]
     */
    public function findAllIndicateursByRapport(string $rapportID): array
    {
        /** @var DraftRequest $rapport */
        $rapport = $this->findRapport($rapportID);

        $indicateurs = [];

        foreach($rapport->getMissions() as $mission) {
            foreach($mission->getIndicateurs() as $indicateur) {
                $indicateurs[] = $indicateur;
            }
        }
        return  $indicateurs;
    }

    /**
     * @param string $rapportID
     *
     * @return array|object
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findRapport(string $rapportID)
    {
        $result = $this->createQueryBuilder('pam_d')
            ->where('pam_d.number = :rapportID')
            ->setParameter('rapportID', $rapportID)
            ->getQuery()
            ->getSingleResult();

        return $this->serializer->deserialize($result->getBody(), DraftRequest::class, 'json');
    }

    /**
     * @param \DateTime $firstDate
     * @param \DateTime $lastDate
     *
     * @return array
     */
    public function findByDateRange(\DateTime $firstDate, \DateTime $lastDate, bool $wholeTeams = true) : array
    {
        $qb = $this->createQueryBuilder('pam_d')
            ->where('pam_d.start_datetime BETWEEN :firstDate AND :lastDate')
            ->setParameter('firstDate', $firstDate)
            ->setParameter('lastDate', $lastDate);

        if(!$wholeTeams) {
            $qb->andWhere('pam_d.created_by = :service')
                ->setParameter('service', $this->tokenStorage->getToken()->getUser());
        }

        $results = $qb->getQuery()->getResult();

        $rapports = [];
        foreach($results as $result) {
            $rapports[] = $this->serializer->deserialize($result->getBody(), DraftRequest::class, 'json');
        }

        return $rapports;
    }
}
