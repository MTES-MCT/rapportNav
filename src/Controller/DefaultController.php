<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\Service;
use App\Entity\User;
use App\Form\MissionAdministratifType;
use App\Form\MissionAutreType;
use App\Form\MissionCommerceType;
use App\Form\MissionFormationType;
use App\Form\MissionLoisirType;
use App\Form\MissionNavireType;
use App\Form\MissionPechePiedType;
use App\Form\MissionSecoursType;
use App\Form\RapportType;
use App\Helper\TimeConvert;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Psr\Log\LoggerInterface;
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
        $rapportData = [];
        /** @var User $user */
        $user = $this->getUser();

        $service = $user->getService();
        $rapport->setServiceCreateur($service);

        try {
            $start = new DateTimeImmutable('t08:00');
            $end = new DateTimeImmutable('t16:45');
        } catch(Exception $e) {
            throw new InvalidArgumentException("Erreur à l'initialisation du formulaire : impossible de récupérer la date et l'heure courante");
        }
        $rapport->setDateDebutMission($start);
        $rapport->setDateFinMission($end);

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $service]);

        $forms['navire'] = $this->createForm(MissionNavireType::class, null, ['service' => $service]);
        $forms['commerce'] = $this->createForm(MissionCommerceType::class, null, ['service' => $service]);
        $forms['pechePied'] = $this->createForm(MissionPechePiedType::class, null, ['service' => $service]);
        $forms['loisir'] = $this->createForm(MissionLoisirType::class, null, ['service' => $service]);
        $forms['autre'] = $this->createForm(MissionAutreType::class, null, ['service' => $service]);
        $forms['secours'] = $this->createForm(MissionSecoursType::class, null, ['service' => $service]);
        $forms['administratif'] = $this->createForm(MissionAdministratifType::class, null, ['service' => $service]);
        $forms['formation'] = $this->createForm(MissionFormationType::class, null, ['service' => $service]);

        $form->handleRequest($request);
        foreach($forms as $name => $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addMission($subForm->getData());
            } elseif($subForm->isSubmitted()) {
                $rapportData['error'] = true;
                $rapportData['error_where'] = $name;
            }
        }

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Rapport enregistré");
            return $this->redirectToRoute('list_submissions');
        }

        $crud = ['deletable' => true, 'draftable' => true];

        return $this->render('rapport.html.twig', [
            'crud' => $crud,
            'form' => $form->createView(),
            'formNavire' => $forms['navire']->createView(),
            'formCommerce' => $forms['commerce']->createView(),
            'formPechePied' => $forms['pechePied']->createView(),
            'formLoisir' => $forms['loisir']->createView(),
            'formAutre' => $forms['autre']->createView(),
            'formSecours' => $forms['secours']->createView(),
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
            'rapport' => $rapportData,
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

        /** @var Service $service */
        $service = $this->getUser()->getService();
        if($rapport->getServiceCreateur() !== $service) {
            throw $this->createNotFoundException("Rapport non trouvé pour ce service");
        }

        $currentMissions = [];
        $rapportData = [];

        $forms['navire'] = $this->createForm(MissionNavireType::class, null, ['service' => $service]);
        $forms['commerce'] = $this->createForm(MissionCommerceType::class, null, ['service' => $service]);
        $forms['pechePied'] = $this->createForm(MissionPechePiedType::class, null, ['service' => $service]);
        $forms['loisir'] = $this->createForm(MissionLoisirType::class, null, ['service' => $service]);
        $forms['autre'] = $this->createForm(MissionAutreType::class, null, ['service' => $service]);
        $forms['secours'] = $this->createForm(MissionSecoursType::class, null, ['service' => $service]);
        $forms['administratif'] = $this->createForm(MissionAdministratifType::class, null, ['service' => $service]);
        $forms['formation'] = $this->createForm(MissionFormationType::class, null, ['service' => $service]);

        foreach($rapport->getMissions() as $mission) {
            if($mission) {
                $nbChar = strlen("App\\Entity\\Mission");
                $currentMissions[lcfirst(mb_substr(get_class($mission), $nbChar))] = $mission;
            }
        }
        if($rapport->getRepartitionHeures()) {
            $rapportData['timeDivision'] = [
                'controleMer' => $rapport->getRepartitionHeures()->getControleMer() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getControleMer())->format("H:i") : null,
                'controleTerre' => $rapport->getRepartitionHeures()->getControleTerre() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getControleTerre())->format("H:i") : null,
                'controleAireProtegeeMer' => $rapport->getRepartitionHeures()->getControleAireProtegeeMer() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getControleAireProtegeeMer())->format("H:i") : null,
                'controleAireProtegeeTerre' => $rapport->getRepartitionHeures()->getControleAireProtegeeTerre() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getControleAireProtegeeTerre())->format("H:i") : null,
                'visiteSecurite' => $rapport->getRepartitionHeures()->getVisiteSecurite() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getVisiteSecurite())->format("H:i") : null,
                'surveillanceManifestationMer' => $rapport->getRepartitionHeures()->getSurveillanceManifestationMer() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getSurveillanceManifestationMer())->format("H:i") : null,
                'surveillanceManifestationTerre' => $rapport->getRepartitionHeures()->getSurveillanceManifestationTerre() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getSurveillanceManifestationTerre())->format("H:i") : null,
                'surveillanceDpmMer' => $rapport->getRepartitionHeures()->getSurveillanceDpmMer() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getSurveillanceDpmMer())->format("H:i") : null,
                'surete' => $rapport->getRepartitionHeures()->getSurete() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getSurete())->format("H:i") : null,
                'maintienOrdre' => $rapport->getRepartitionHeures()->getMaintienOrdre() ? TimeConvert::minutesToTime($rapport->getRepartitionHeures()->getMaintienOrdre())->format("H:i") : null,
                'nombreOperationMaintienOrdre' => $rapport->getRepartitionHeures()->getNombreOperationMaintienOrdre(),
            ];
        }

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $service]);

        $form->handleRequest($request);
        foreach($forms as $name => $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addMission($subForm->getData());
            } elseif($subForm->isSubmitted()) {
                $rapportData['error'] = true;
                $rapportData['error_where'] = $name;
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
            'formLoisir' => $forms['loisir']->createView(),
            'formAutre' => $forms['autre']->createView(),
            'formSecours' => $forms['secours']->createView(),
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
            'missions' => $currentMissions,
            'rapport' => $rapportData,
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
        $metabaseDashboard = $this->getParameter("metabase_dashboard");

        $signer = new Sha256();
        $token = (new Builder())
            ->set('resource', [
                'dashboard' => (int)$metabaseDashboard
            ])
            ->set('params', (Object)null)
            ->set('iat', time())
            ->set('_embedding_params', (Object)null)
            ->sign($signer, $metabaseSecretKey)
            ->getToken();

        $iframeUrl = $metabaseDbUrl."embed/dashboard/".$token."#bordered=true&titled=true";

        return $this->render('listForms.html.twig', ['iframeUrl' => $iframeUrl]);

    }

    /**
     * @Route("/list_submissions", name="list_submissions", methods={"GET"})
     *
     * @param EntityManagerInterface $em
     * @param LoggerInterface        $logger
     *
     * @return Response
     */
    public function listSubmission(EntityManagerInterface $em, LoggerInterface $logger) {
        $userService = $this->getUser()->getService();

        try {
            $now = new DateTimeImmutable("01-".date("m")."-".date("Y"));
            $prevMonthDate = (new DateTime())->modify('previous month');
            $prevMonth = new DateTimeImmutable("01-".$prevMonthDate->format("m")."-".$prevMonthDate->format("Y"));
        } catch(\Exception $e) {
            $logger->critical("Fail to initialize date");
            $this->addFlash("error", "Une erreur est survenue en tentant d'afficher la page, vous avez été redirigé⋅ sur la page d'accueil. ");
            return $this->redirectToRoute('home');
        }

        $reports = $em->getRepository('App:Rapport')->findByPeriod(
            $now,
            null,
            $userService,
            200);
        $pastReports = $em->getRepository('App:Rapport')->findByPeriod(
            $prevMonth,
            $now,
            $userService,
            200);

        return $this->render('listSubmissions.html.twig', [
            'currentReports' => $reports,
            'previousMounthReports' => $pastReports,
            'date' => $prevMonth->format("d-m-Y")
        ]);
    }

    /**
     * @Route("/list_submissions/{date}",
     *     name="list_submissions_by_date",
     *     requirements={"date"="\d{2}-\d{2}-\d{4}"},
     *     methods={"GET"})
     *
     * @param EntityManagerInterface $em
     * @param LoggerInterface        $logger
     * @param DateTime               $date
     *
     * @return Response
     */
    public function listSubmissionByDate(EntityManagerInterface $em, LoggerInterface $logger, DateTime $date) {
        $userService = $this->getUser()->getService();

        try {
            $nextMonthDate = clone $date;
            $nextMonthDate->modify('next month');
            $nextMonth = new DateTimeImmutable("01-".$nextMonthDate->format("m")."-".$nextMonthDate->format("Y"));
            $prevMonthDate = clone $date;
            $prevMonthDate->modify('previous month');
            $prevMonth = new DateTimeImmutable("01-".$prevMonthDate->format("m")."-".$prevMonthDate->format("Y"));
        } catch(\Exception $e) {
            $logger->critical("Fail to initialize date");
            $this->addFlash("error", "Une erreur est survenue en tentant d'afficher la page, vous avez été redirigé⋅ sur la page d'accueil. ");
            return $this->redirectToRoute('home');
        }
        $reports = $em->getRepository('App:Rapport')->findByPeriod(
            $date,
            $nextMonth,
            $userService,
            200);
        dump($reports);
        dump($date);
        dump($nextMonth);
        dump($prevMonth);

        return $this->render('listReports.html.twig', [
            'reports' => $reports,
            'date' => $date,
            'nextDate' => $nextMonth->format("d-m-Y")
        ]);
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
