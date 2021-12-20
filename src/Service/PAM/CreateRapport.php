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
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateRapport {

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @param PamRapport $rapport
     * @param null       $id
     *
     * @return PamRapport
     */
    public function persistAndFlush(PamRapport $rapport, $id = null) : PamRapport
    {
        $this->setType($rapport->getControles(), PamControleType::class);
        $this->setType($rapport->getMissions(), PamMissionType::class);
        foreach($rapport->getMissions() as $mission) {
            $this->setType($mission->getIndicateurs(), PamIndicateurType::class);
        }
        $this->setMembres($rapport->getEquipage());
        $errors = $this->validator->validate($rapport);

        if($errors) {
            throw new BadRequestHttpException((string) $errors);
        }

        $this->em->persist($rapport);
        $this->em->flush();
        return $rapport;
    }

    /**
     * @param string        $json
     * @param string        $number
     * @param UserInterface $user
     *
     * @param int|null      $id
     *
     * @return void
     */
    public function saveDraft(string $json, string $number, UserInterface $user, int $id = null): PamDraft
    {

        $draft = new PamDraft();
        if($id) {
            $draft = $this->showDraftById($id);
        }
        $draft->setBody($json);
        $draft->setNumber($number);
        $draft->setCreatedBy($user);
        $this->em->persist($draft);
        $this->em->flush();
        return $draft;

    }

    /**
     * @param int $id
     *
     * @return PamDraft
     */
    public function showDraftById(int $id) : PamDraft
    {
        $draft = $this->em->getRepository(PamDraft::class)->find($id);
        if(!$draft) {
            throw new NotFoundHttpException('Brouillon non trouvé');
        }
        return $draft;
    }

    /**
     * @param int $id
     *
     * @return PamRapport
     */
    public function showRapportById(int $id) : PamRapport
    {

        $rapport = $this->em->getRepository(PamRapport::class)->find($id);
        if(!$rapport) {
            throw new NotFoundHttpException('Rapport non trouvé');
        }
        return $rapport;
    }

    /**
     * @param $user
     *
     * @return PamDraft|null
     */
    public function getLastDraft($user) : ?PamDraft
    {
        return $this->em->getRepository(PamDraft::class)->findOneBy(['created_by' => $user], ['created_at' => 'DESC']);
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
