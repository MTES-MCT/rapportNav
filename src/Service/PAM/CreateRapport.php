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

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->validator = $validator;
        $this->serializer = $serializer;
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
        $rapport->setCreatedBy($service);
        $rapport->setId($this->generateRapportId());
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
        }
        $draft->setBody($json);
        $draft->setNumber($this->generateRapportId());
        $draft->setCreatedBy($service);
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

    /**
     * @return string
     */
    private function generateRapportId(): string
    {
        $currentDate = new \DateTime();
        $count = $this->em->getRepository(PamRapport::class)->countAll();
        $number = $count > 0 ? $count+1 : 1;
        return'MED-' . $currentDate->format('Y') . '-' . $number;
    }

}
