<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamAgent;
use App\Entity\PAM\CategoryPamControle;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\CategoryPamIndicateur;
use App\Entity\PAM\PamMembre;
use App\Entity\PAM\CategoryPamMission;
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
        $this->setCategory($rapport->getControles(), CategoryPamControle::class);
        $this->setCategory($rapport->getMissions(), CategoryPamMission::class);
        foreach($rapport->getMissions() as $mission) {
            $this->setCategory($mission->getIndicateurs(), CategoryPamIndicateur::class);
        }
        $this->setAgent($rapport->getEquipage());
        $errors = $this->validator->validate($rapport);

        if($errors->count() > 0) {
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
    private function setCategory(Collection $collections, string $entityClass): void
    {
        $typeRepo = $this->em->getRepository($entityClass);
        foreach($collections as $collection) {
            $type = $typeRepo->find($collection->getCategory()->getId());
            if($type) {
                $collection->setCategory($type);
            } else {
                throw new NotFoundHttpException('Category not foud for ' . $entityClass);
            }
        }
    }

    /**
     * Check if membres exist and set it 
     * @param PamEquipage $equipage
     *
     * @return void
     */
    private function setAgent(PamEquipage $equipage)
    {
        /** @var PamEquipageAgent $membre */
       foreach($equipage->getMembres() as $membre) {
           $idAgent = $membre->getAgent()->getId();
           $agent = $idAgent ? $this->em->getRepository(PamAgent::class)->find($idAgent) : null;
           if($agent) {
                $membre->setAgent($agent);
           }
        }
    }

}
