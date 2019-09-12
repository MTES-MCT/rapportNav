<?php

namespace App\Controller;

use App\Entity\MissionSecours;
use App\Entity\Navire;
use App\Entity\Rapport;
use App\Entity\Service;
use App\Entity\User;
use App\Form\MissionAdministratifType;
use App\Form\MissionCommerceType;
use App\Form\MissionFormationType;
use App\Form\MissionNavireType;
use App\Form\MissionPechePiedType;
use App\Form\MissionSecoursType;
use App\Form\RapportType;
use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    private $typeRapportToClass = ['controle_a_bord' => "MissionNavire",
        'filiere_commercialisation' => "MissionCommerce",
        'administratif' => "MissionAdministratif",
        "formation" => "MissionFormation",
        "peche_a_pied" => "MissionPechePied",
    ];

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }

    /**
     * @Route("/rapport", name="rapport_create")
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse|Response
     */
    public function rapportCreate(Request $request, EntityManagerInterface $em) {
        /** @var Rapport $rapport */
        $rapport = new Rapport();
        /** @var User $user */
        $user = $this->getUser();

        $service = $user->getService();
        $rapport->setServiceCreateur($service);

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $service]);

        $forms['navire'] = $this->createForm(MissionNavireType::class, null, ['service' => $service]);
        $forms['commerce'] = $this->createForm(MissionCommerceType::class, null, ['service' => $service]);
        $forms['pechePied'] = $this->createForm(MissionPechePiedType::class, null, ['service' => $service]);
        $forms['secours'] = $this->createForm(MissionSecoursType::class, null, ['service' => $service]);
        $forms['administratif'] = $this->createForm(MissionAdministratifType::class, null, ['service' => $service]);
        $forms['formation'] = $this->createForm(MissionFormationType::class, null, ['service' => $service]);


        $form->handleRequest($request);
        foreach($forms as $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addMission($subForm->getData());
            }
        }

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Rapport enregistré");
            return $this->redirectToRoute('list_submissions');
        }

        //Setting default values on new form
        if(!$form->isSubmitted()) {
            try {
                $now = new DateTimeImmutable();
                $later = $now->add(new DateInterval('PT2H'));
            } catch(Exception $e) {
                throw new InvalidArgumentException("Erreur à l'initialisation du formulaire : impossible de récupérer la date et l'heure courante");
            }
            $form->get('dateDebutMission')->setData($now);
            $form->get('dateFinMission')->setData($later);
        }

        $crud = ['deletable' => true, 'draftable' => true];


        return $this->render('rapport.html.twig', [
            'crud' => $crud,
            'form' => $form->createView(),
            'formNavire' => $forms['navire']->createView(),
            'formCommerce' => $forms['commerce']->createView(),
            'formPechePied' => $forms['pechePied']->createView(),
            'formSecours' => $forms['secours']->createView(),
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
        ]);
    }

    /**
     * @Route("/rapport/edit/{id_edit}", name="rapport_edit", requirements={"id_edit": "\d+"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param int|null               $id_edit
     *
     * @return RedirectResponse|Response
     */
    public function rapportEdit(Request $request, EntityManagerInterface $em, int $id_edit = null) {
        if(null === $rapport = $em->getRepository(Rapport::class)->find($id_edit)) {
            throw $this->createNotFoundException('Pas de contrôle trouvé avec cet identifiant '.$id_edit);
        }

        /** @var Service $userService */
        $userService = $this->getUser()->getService();
        if($rapport->getServiceCreateur() !== $userService) {
            throw $this->createNotFoundException("Rapport non trouvé pour ce service");
        }

        $currentMissions = [];

        $forms['navire'] = $this->createForm(MissionNavireType::class, null, ['service' => $userService]);
        $forms['commerce'] = $this->createForm(MissionCommerceType::class, null, ['service' => $userService]);
        $forms['pechePied'] = $this->createForm(MissionPechePiedType::class, null, ['service' => $userService]);
        $forms['secours'] = $this->createForm(MissionSecoursType::class, null, ['service' => $userService]);
        $forms['administratif'] = $this->createForm(MissionAdministratifType::class, null, ['service' => $userService]);
        $forms['formation'] = $this->createForm(MissionFormationType::class, null, ['service' => $userService]);

        foreach($rapport->getMissions() as $mission) {
            if($mission) {
                $nbChar = strlen("App\\Entity\\Mission");
                $currentMissions[lcfirst(mb_substr(get_class($mission), $nbChar))] = $mission;
            }
        }

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $userService]);

        $form->handleRequest($request);
        foreach($forms as $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addMission($subForm->getData());
            }
        }

        if($form->isSubmitted() && $form->isValid()) {

            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Modification enregistrée");

            return $this->redirectToRoute('list_submissions');
        }

        $crud = ['deletable' => false, 'draftable' => false];
        return $this->render('rapport.html.twig', [
            'crud' => $crud,
            'form' => $form->createView(),
            'formNavire' => $forms['navire']->createView(),
            'formCommerce' => $forms['commerce']->createView(),
            'formPechePied' => $forms['pechePied']->createView(),
            'formSecours' => $forms['secours']->createView(),
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
            'missions' => $currentMissions,
        ]);
    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     *
     * @return Response
     */
    public function listForms() {

        $metabaseSecretKey = $this->getParameter("metabase_key");
        $metabaseDbUrl = $this->getParameter("metabase_url");


        $token = "";

        $signer = new Sha256();
        $token = (new Builder())
            ->set('resource', [
                'dashboard' => 3
            ])
            ->set('params', [
                'params' => ''
            ])
            ->sign($signer, $metabaseSecretKey)
            ->getToken();

        $metabaseDbUrl .= $token."#bordered=true&titled=true";

        return $this->render('listForms.html.twig', ['iframeUrl' => $metabaseDbUrl]);

    }

    /**
     * @Route("/list_submissions", name="list_submissions", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listSubmission(EntityManagerInterface $em) {
        $userService = $this->getUser()->getService();

        $drafts = $em->getRepository("App:Draft")->findBy(
            ['owner' => $userService],
            ['lastEdit' => "DESC"],
            20);

        $rapports = $em->getRepository('App:Rapport')->findBy(
            ['serviceCreateur' => $userService],
            ['dateDebutMission' => "DESC"],
            20);

        $list = ['Contrôle de navire' => $rapports,
            'Contrôle de la filière commercialisation' => [],
            'Contrôle de la pêche à pied' => [],
            'Actions administratives' => [],
            'Actions de formation' => [],
        ];

        return $this->render('listSubmissions.html.twig', ['list' => $list, 'drafts' => $drafts]);
    }

    /**
     * @Route("/show_kpi", name="show_kpi", methods={"GET"})
     *
     * @return Response
     */
    public function showKpi() {

        return $this->render('listKpi.html.twig');

    }


    /**
     * @Route("/export/sati", name="export_sati", methods={"GET"})
     *
     */
    public function exportSati() {
        $filePath = $this->getParameter('kernel.project_dir')."/export_ulam56_20190909.zip";

        $response = new BinaryFileResponse ($filePath);
        $response->headers->set('Content-Type', 'application/zip');

        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            "export_ulam56_20190909.zip"
        );

        return $response;

    }

}
