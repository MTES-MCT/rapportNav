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

    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
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

        /** @var DraftRequest $rapport */
        return $this->serializer->deserialize($result->getBody(), DraftRequest::class, 'json');
    }
}
