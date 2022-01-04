<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamAgent;
use App\Entity\PAM\CategoryPamControle;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\CategoryPamIndicateur;
use App\Entity\PAM\CategoryPamMission;
use App\Entity\PAM\PamRapport;
use App\Entity\Service;
use App\Service\PAM\Utils\GenerateID;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;
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

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var GenerateID
     */
    private $generateID;

    public function __construct(EntityManagerInterface $em,
                                ValidatorInterface $validator,
                                SerializerInterface $serializer,
                                GenerateID $generateID
    )
    {
        $this->em = $em;
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->generateID = $generateID;
    }

    /**
     * @param PamRapport $rapport
     * @param Service    $service
     *
     * @return PamRapport
     */
    public function persistAndFlush(PamRapport $rapport, Service $service) : PamRapport
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
        if(!$rapport->getId()) {
            $rapport->setId($this->generateID->generate());
        }
        $rapport->setCreatedBy($service);

        $this->em->persist($rapport);
        $this->em->flush();
        return $rapport;
    }

    /**
     * @param PamRapport $rapport
     * @param Service    $service
     * @param int|null   $id
     *
     * @return void
     */
    public function saveDraft(PamRapport $rapport, Service $service, int $id = null): PamDraft
    {
        $error = $this->validator->validateProperty($rapport, 'start_datetime');

        if($error->count() > 0) {
            throw new BadRequestHttpException((string) $error);
        }

        $json = $this->serializer->serialize($rapport, 'json', ['groups' => 'draft']);

        $draft = new PamDraft();
        if($id) {
            $draft = $this->showDraftById($id);
        } else {
            $draft->setNumber($this->generateID->generate());
        }
        $draft->setBody($json);
        $draft->setCreatedBy($service);
        $draft->setStartDatetime($rapport->getStartDatetime());
        $this->em->persist($draft);
        $this->em->flush();
        return $draft;

    }

    /**
     * @param string $id
     *
     * @return PamDraft
     */
    public function showDraftById(string $id) : PamDraft
    {
        $draft = $this->em->getRepository(PamDraft::class)->findOneBy(['number' => $id]);
        if(!$draft) {
            throw new NotFoundHttpException('Brouillon non trouvé');
        }
        return $draft;
    }

    /**
     * @param string $id
     *
     * @return PamRapport
     */
    public function showRapportById(string $id) : PamRapport
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
