<?php

namespace App\Service\PAM\Utils;

use App\Entity\PAM\PamRapportId;
use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamRapportIdRepository;
use App\Repository\PAM\PamRapportRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GenerateID {


    protected $pamIDRepo;

    protected $em;

    public function __construct(PamRapportIdRepository $pamIDRepo, EntityManagerInterface $em)
    {
        $this->pamIDRepo = $pamIDRepo;
        $this->em = $em;
    }

    public function generate(): string
    {
        $id = $this->availableID();
        $idRapport = new PamRapportId();
        $idRapport->setId($id);
        $this->em->persist($idRapport);
        $this->em->flush();

        return $id;
    }

    private function availableID()
    {
        $lastIDKey = $this->pamIDRepo->findIDAvailable();
        $currentYear = new \DateTime();
        $currentYear = $currentYear->format('Y');
        $idKey = $lastIDKey + 1;

        return 'MED-' . $currentYear . '-' . $idKey;
    }

}
