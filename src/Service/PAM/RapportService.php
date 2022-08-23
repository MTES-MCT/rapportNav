<?php

namespace App\Service\PAM;

use App\Entity\FonctionAgent;
use App\Entity\FonctionParticuliereAgent;
use App\Entity\PAM\CategoryPamControle;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamEquipageAgent;
use App\Entity\PAM\CategoryPamIndicateur;
use App\Entity\PAM\CategoryPamMission;
use App\Entity\PAM\PamRapport;
use App\Entity\Agent;
use App\Entity\Service;
use App\Service\PAM\Utils\GenerateID;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RapportService {

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
        $this->setAgent($rapport->getEquipage(), $service);
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
     * @param PamRapport  $rapport
     * @param Service     $service
     * @param string|null $id
     *
     * @return void
     */
    public function saveDraft($content, Service $service, string $id = null): PamDraft
    {
        $arrayBody = json_decode($content,true);
        $startDateTime = $arrayBody['start_datetime'];

        if(!$startDateTime) {
            throw new BadRequestHttpException('La date de début est manquante.');
        }


        $draft = new PamDraft();
        if($id) {
            $draft = $this->showDraftById($id);
            if($draft->getCreatedBy() !== $service) {
                throw new BadRequestHttpException('User not authorized');
            }
        } else {
            $draft->setNumber($this->generateID->generate());
        }
        $draft->setBody($content);
        $draft->setCreatedBy($service);
        $draft->setStartDatetime($startDateTime);
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
     * @param Service $service
     *
     * @return PamDraft|null
     */
    public function getLastDraft(Service $service) : ?PamDraft
    {
        $draft = $this->em->getRepository(PamDraft::class)->findOneBy(['created_by' => $service], ['created_at' => 'DESC']);
        if(!$draft) {
            return null;
        }
        $rapport = $this->em->getRepository(PamRapport::class)->find($draft->getNumber());
        if(!$rapport) {
            return $draft;
        }
        return null; // Null because rapport already validated
    }

    /**
     * @param FormInterface $form
     * @param Request       $request
     * @param PamRapport    $existingRapport
     *
     * @return PamRapport
     */
    public function updateRapport(FormInterface $form, Request $request, PamRapport $existingRapport, Service $service) : PamRapport
    {

        if($existingRapport->getCreatedBy() !== $service) {
            throw new BadRequestHttpException('User not authorized');
        }
        /** @var PamRapport $rapport */
        $rapport = $this->serializer->deserialize($request->getContent(), PamRapport::class, 'json'); // Mapping de la request en entity PamRapport

        $existingRapport->setStartDatetime($rapport->getStartDatetime());
        $existingRapport->setEndDatetime($rapport->getEndDatetime());

        if($rapport->getEquipage()) {
            $this->setAgent($rapport->getEquipage(), $service);
            $existingRapport->setEquipage($rapport->getEquipage()); // Ajout des membres d'équipage
        }

        if($rapport->getControles()) {
            $this->setCategory($rapport->getControles(), CategoryPamControle::class);
            $existingRapport->getControles()->clear(); // clear controles
            foreach($rapport->getControles() as $controle) {
                $existingRapport->addControle($controle); // ajout controle present dans la request (existant + nouveau)
            }
        }

        if($rapport->getMissions()) {
            $this->setCategory($rapport->getMissions(), CategoryPamMission::class);
            $existingRapport->getMissions()->clear(); // clear missions
            foreach($rapport->getMissions() as $mission) {
                $this->setCategory($mission->getIndicateurs(), CategoryPamIndicateur::class); // verification des indicateurs
                $existingRapport->addMission($mission); // ajout missions present dans la request (existant + nouveau)
            }
        }

        $existingRapport->setAutreMission($rapport->getAutreMission());

        $formData = json_decode($request->getContent(), true); // conversion json request en array

        $form->submit($formData, false); // submit du formulaire avec les nouveaux elements

        $errors = $this->validator->validate($existingRapport);

        if($errors->count() > 0) {
            throw new BadRequestHttpException((string) $errors);
        }

        $this->em->flush();

        return $existingRapport;
    }

    /**
     * @return array
     */
    public function listAll(): array
    {
        $drafts = $this->em->getRepository(PamDraft::class)->findAll();
        $rapports = $this->em->getRepository(PamRapport::class)->findAll();

        return $this->handleRapportAndDraft($rapports, $drafts);
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
    private function setAgent(PamEquipage $equipage, Service $service): void
    {
        /** @var PamEquipageAgent $membre */
       foreach($equipage->getMembres() as $membre) {
           $idAgent = $membre->getAgent()->getId();
           $agent = $idAgent ? $this->em->getRepository(Agent::class)->findOneBy(['id' => $idAgent, 'service' => $service]) : null;
           if($agent) {
                $membre->setAgent($agent);
           } else {
               $membre->getAgent()->setService($service);
           }

           $nomFonction = $membre->getFonction() ? $membre->getFonction()->getNom() : null;
            $fonction = $nomFonction ? $this->em->getRepository(FonctionAgent::class)->findOneBy(['nom' => $nomFonction]) : null;
            if($fonction) {
                $membre->setFonction($fonction);
            }

            $nomFonctionParticuliere = $membre->getFonctionParticuliere() ? $membre->getFonctionParticuliere()->getNom() : null;
            $fonctionParticuliere = $nomFonctionParticuliere ? $this->em->getRepository(FonctionParticuliereAgent::class)->findOneBy(['nom' => $nomFonctionParticuliere]) : null;
            if($fonctionParticuliere) {
                $membre->setFonctionParticuliere($fonctionParticuliere);
            } else {
                $membre->setFonctionParticuliere(null);
            }
        }
    }

    public function handleRapportAndDraft(array $rapports, array $drafts): array
    {
        $results = [];
        $idsRapport = [];
        foreach($rapports as $rapport) {
            $results[] = $rapport;
            $idsRapport[] = $rapport->getId();
        }

        foreach($drafts as $draft) {
            if(!in_array($draft->getNumber(), $idsRapport)) {
                $results[] = $draft;
            }
        }

        return $results;
    }


}
