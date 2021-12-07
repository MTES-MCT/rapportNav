<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamControleType;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamMembre;
use App\Entity\PAM\PamRapport;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateRapport {

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param PamRapport $rapport
     *
     * @return PamRapport
     */
    public function persistAndFlush(PamRapport $rapport) : PamRapport
    {
        $this->setType($rapport->getControles());
        $this->setMembres($rapport->getEquipage());

        $this->em->persist($rapport);
        $this->em->flush();
        return $rapport;
    }

    /**
     * Add type to controles
     * @param Collection $controles
     *
     * @return void
     */
    private function setType(Collection $controles): void
    {
        $typeRepo = $this->em->getRepository(PamControleType::class);
        foreach($controles as $controle) {
            $type = $typeRepo->find($controle->getType()->getId());
            if($type) {
                $controle->setType($type);
            } else {
                throw new NotFoundHttpException('Controle type not foud');
            }
        }
    }

    /**
     * Check if membres exist and set it 
     * @param PamEquipage $equipage
     *
     * @return void
     */
    private function setMembres(PamEquipage $equipage)
    {
        $repository = $this->em->getRepository(PamMembre::class);
        /** @var PamMembre $membre */
        foreach($equipage->getMembres() as $membre) {
            $result = $repository->find($membre->getId());
            if($result) {
                $result->setNom($membre->getNom());
                $result->setRole($membre->getRole());
                $result->setObservations($membre->getObservations());
                $equipage->addMembre($result);
                $equipage->removeMembre($membre); // avoid cascade persist if member already exist
            }
        }
    }

}