<?php

namespace App\Service\PAM\Utils;

use App\Entity\PAM\PamRapportId;
use App\Repository\PAM\PamRapportIdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GenerateID {


    protected $pamIDRepo;

    protected $em;

    protected $tokenStorage;

    public function __construct(PamRapportIdRepository $pamIDRepo, EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
    {
        $this->pamIDRepo = $pamIDRepo;
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
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
        $quadrigramme = $this->tokenStorage->getToken()->getUser()->getService()->getQuadrigramme();
        return "$quadrigramme-$currentYear-$idKey";
    }

}
