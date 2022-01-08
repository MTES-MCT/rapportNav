<?php

namespace App\Repository\PAM;

use App\Entity\PAM\PamRapportId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PamRapportId|null find($id, $lockMode = null, $lockVersion = null)
 * @method PamRapportId|null findOneBy(array $criteria, array $orderBy = null)
 * @method PamRapportId[]    findAll()
 * @method PamRapportId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PamRapportIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PamRapportId::class);
    }

    public function findIDAvailable(): ?int
    {
        $result = $this->findOneBy([], ['id' => 'DESC']);
        return $result ? (int)explode('-', $result->getId())[2] : 0;
    }
}
