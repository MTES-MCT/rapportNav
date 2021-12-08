<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamControleType;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamIndicateurType;
use App\Entity\PAM\PamMembre;
use App\Entity\PAM\PamMissionType;
use App\Entity\PAM\PamRapport;
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
        $this->setType($rapport->getControles(), PamControleType::class);
        $this->setType($rapport->getMissions(), PamMissionType::class);
        foreach($rapport->getMissions() as $mission) {
            $this->setType($mission->getIndicateurs(), PamIndicateurType::class);
        }
        $this->setMembres($rapport->getEquipage());

        $this->em->persist($rapport);
        $this->em->flush();
        return $rapport;
    }

    /**
     * @param string $json
     *
     * @return void
     */
    public function saveDraft(string $json)
    {
        $draft = new PamDraft();
        $draft->setBody($json);
        $this->em->persist($draft);
        $this->em->flush();

    }

    public function showDraftById(int $id)
    {
        $draft = $this->em->getRepository(PamDraft::class)->find($id);
        if(!$draft) {
            throw new NotFoundHttpException('Brouillon non trouvé');
        }
        return $draft;
    }

    /**
     * Add type to controles
     *
     * @param Collection $collections
     * @param string     $entityClass
     *
     * @return void
     */
    private function setType(Collection $collections, string $entityClass): void
    {
        $typeRepo = $this->em->getRepository($entityClass);
        foreach($collections as $collection) {
            $type = $typeRepo->find($collection->getType()->getId());
            if($type) {
                $collection->setType($type);
            } else {
                throw new NotFoundHttpException('Type not foud for ' . $entityClass);
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