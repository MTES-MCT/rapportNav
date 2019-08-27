<?php

namespace App\Controller;

use App\Entity\Draft;
use App\Entity\Rapport;
use App\Entity\RapportMoyen;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DraftController extends AbstractController {
    private $typeRapportToClass = ['controle_a_bord' => "MissionNavire",
        'filiere_commercialisation' => "MissionCommerce",
        'administratif' => "MissionAdministratif",
        "formation" => "MissionFormation",
        "peche_a_pied" => "MissionPechePied",
    ];

    /**
     * @Route("rapport/{type}/draft/{id}",
     *     methods={"POST"},
     *     name="rapport_draft",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param string                 $type
     *
     * @param int|null               $id
     *
     * @return Response
     * @throws Exception For DateTimeImmutable creation
     */
    public function saveNew(Request $request, EntityManagerInterface $em, string $type, ?int $id = null) {
        $data = json_decode($request->getContent(), true);

        if(null === $data) {
            throw new BadRequestHttpException("No data found for draft");
        }

        //Search and delete the CRSF token and re-number the elements (Moyens, PecherAPied, NAvires and Etablissements
        $renumbers = ["[moyens][" => 0, "[pecheursPied][" => 0, "[navires][" => 0, "[etablissements][" => 0];
        for($i = 0 ; $i < count($data) ; $i++) {

            foreach($renumbers as $elemName => $nbElems) {
                $j = 0;
                $oldName = "";
                while(($pos = mb_strpos($data[$i + $j]['name'], $elemName)) &&
                    ("" === $oldName || false !== mb_strpos($data[$i + $j]['name'], $oldName))
                ) {
                    if(0 === $j) {
                        $oldName = substr($data[$i]['name'], 0, $pos + mb_strlen($elemName) + 1);
                    }
                    $data[$i + $j]['name'] = substr($data[$i + $j]['name'], 0, $pos + mb_strlen($elemName)).
                        $nbElems.
                        substr($data[$i + $j]['name'], $pos + mb_strlen($elemName) + 1);
                    $j++;
                }
                if($j > 0) {
                    $renumbers[$elemName]++;

                    $i += $j - 1;
                    continue 2;
                }
            }

            if(mb_strpos($data[$i]['name'], "_token")) {
                unset($data[$i]);
                continue;
            }
        }

        if(null === $id) {
            $draft = new Draft();
            $draft->setOwner($this->getUser()->getService());
            $draft->setRapportType($type);
        } else {
            $draft = $em->getRepository("App:Draft")->find($id);
        }
        $draft->setData($data);
        $draft->setLastEdit(new DateTimeImmutable());
        $em->persist($draft);
        $em->flush();

        if(in_array("application/json", $request->getAcceptableContentTypes())) {
            return $this->json(["status" => "success",
                "text" => "Brouillon enregistré avec succès"]);
        } else {
            $this->addFlash("success", "Brouillon enregistré avec succès");
            return $this->redirectToRoute("list_submissions");
        }

    }

    /**
     * @Route("rapport/{type}/draft/{id}",
     *     methods={"GET"},
     *     name="rapport_draft_edit",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     * @ParamConverter("draft", class="App:Draft")
     *
     * @param string $type
     * @param Draft  $draft
     *
     * @return Response
     */
    public function edit(string $type, Draft $draft) {
        /** @var User $user */
        $user = $this->getUser();
        if($draft->getOwner() != $user->getService()) {
            throw $this->createNotFoundException("Brouillon non trouvé pour ce service");
        }

        $rapportClass = "\\App\\Entity\\".$this->typeRapportToClass[$type];
        $formClass = "\\App\\Form\\".$this->typeRapportToClass[$type]."Type";
        /** @var Rapport $rapport */
        $rapport = new $rapportClass();
        $rapport->addMoyen(new RapportMoyen());

        $form = $this->createForm(
            $formClass,
            $rapport,
            [
                'action' => $this->generateUrl('rapport_create', ['type' => $type]),
                'service' => $user->getService()
            ]);

        $crud = ['deletable' => true, 'draftable' => true];
        return $this->render("rapport".str_replace('_', '', ucwords($type, '_')).".html.twig",
            ['form' => $form->createView(), 'data' => json_encode($draft->getData()), 'crud' => $crud]);
    }

    /**
     * Deletes a draft
     *
     * @Route("rapport/{type}/draft/{id}",
     * methods={"DELETE"},
     *     name="rapport_draft_delete",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     *
     * @Route("rapport/{type}/draft/{id}/delete",
     * methods={"POST"},
     *     name="rapport_draft_delete_failback",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     *
     * @ParamConverter("draft", class="App:Draft")
     *
     * @param EntityManagerInterface $em
     * @param Request                $request
     * @param Draft                  $draft
     *
     * @return JsonResponse|RedirectResponse
     */
    public function delete(EntityManagerInterface $em, Request $request, Draft $draft) {
        /** @var User $user */
        $user = $this->getUser();
        if($draft->getOwner() !== $user->getService()) {
            throw $this->createNotFoundException("Brouillon non trouvé pour ce service");
        }

        $em->remove($draft);
        $em->flush();

        $text = "Brouillon supprimé avec succès. ";

        if(in_array("application/json", $request->getAcceptableContentTypes())) {
            return $this->json(["status" => "success", "text" => $text]);
        } else {
            $this->addFlash("success", $text);
            return $this->redirectToRoute("list_submissions");
        }
    }
}
