<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\RapportRepartitionHeures;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\MoisClos;
use App\Form\ActiviteAdministratifType;
use App\Form\ActiviteAutreType;
use App\Form\ActiviteCommerceType;
use App\Form\ActiviteFormationType;
use App\Form\ActiviteLoisirType;
use App\Form\ActiviteNavireType;
use App\Form\ActivitePechePiedType;
use App\Form\RapportType;
use App\Helper\TimeConvert;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends AbstractController {

    private $typeRapportToClass = ['controle_a_bord' => "ActiviteNavire",
        'filiere_commercialisation' => "ActiviteCommerce",
        'administratif' => "ActiviteAdministratif",
        "formation" => "ActiviteFormation",
        "peche_a_pied" => "ActivitePechePied",
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
        $rapportData = ['error' => false];
        $currentActivites = [];
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

        $forms['navire'] = $this->createForm(ActiviteNavireType::class, null, ['service' => $service]);
        $forms['commerce'] = $this->createForm(ActiviteCommerceType::class, null, ['service' => $service]);
        $forms['pechePied'] = $this->createForm(ActivitePechePiedType::class, null, ['service' => $service]);
        $forms['loisir'] = $this->createForm(ActiviteLoisirType::class, null, ['service' => $service]);
        $forms['autre'] = $this->createForm(ActiviteAutreType::class, null, ['service' => $service]);
        $forms['administratif'] = $this->createForm(ActiviteAdministratifType::class, null, ['service' => $service]);
        $forms['formation'] = $this->createForm(ActiviteFormationType::class, null, ['service' => $service]);

        $form->handleRequest($request);
        foreach($forms as $name => $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->getData()) {
                $currentActivites[$name] = $subForm->getData();
            }
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addActivite($subForm->getData());
            } elseif($subForm->isSubmitted()) {
                $rapportData['error'] = true;
                foreach($subForm->getErrors(true) as $error) {
                    $rapportData['error_where'][$name][] = (is_numeric($error->getOrigin()->getName()) ?
                        $error->getMessage() :
                        $error->getOrigin()->getName() . " : " . $error->getMessage())
                    ;
                }
            }
        }

        if($form->isSubmitted() && $form->isValid() && false  === $rapportData['error']) {
            $rapport->setVersion($rapport->getVersion()+1);
            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Rapport enregistré");
            return $this->redirectToRoute('list_submissions');
        }

        if($rapport->getRepartitionHeures()) {
            $rapportData['timeDivision'] = $this->makeTimeDivisionArray($rapport->getRepartitionHeures());
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
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
            'activites' => $currentActivites,
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

        $currentActivites = [];
        $rapportData = ['error' => false];

        $forms['navire'] = $this->createForm(ActiviteNavireType::class, null, ['service' => $service]);
        $forms['commerce'] = $this->createForm(ActiviteCommerceType::class, null, ['service' => $service]);
        $forms['pechePied'] = $this->createForm(ActivitePechePiedType::class, null, ['service' => $service]);
        $forms['loisir'] = $this->createForm(ActiviteLoisirType::class, null, ['service' => $service]);
        $forms['autre'] = $this->createForm(ActiviteAutreType::class, null, ['service' => $service]);
        $forms['administratif'] = $this->createForm(ActiviteAdministratifType::class, null, ['service' => $service]);
        $forms['formation'] = $this->createForm(ActiviteFormationType::class, null, ['service' => $service]);

        foreach($rapport->getActivites() as $activite) {
            if($activite) {
                $nbChar = strlen("App\\Entity\\Activite");
                $currentActivites[lcfirst(mb_substr(get_class($activite), $nbChar))] = $activite;
            }
        }

        if($rapport->getRepartitionHeures()) {
            $rapportData['timeDivision'] = $this->makeTimeDivisionArray($rapport->getRepartitionHeures());
        }

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $service]);

        $form->handleRequest($request);
        foreach($forms as $name => $subForm) {
            /** @var FormInterface $subForm */
            $subForm->handleRequest($request);
            if($subForm->getData()) {
                $currentActivites[$name] = $subForm->getData();
            }
            if($subForm->isSubmitted() && $subForm->isValid()) {
                $rapport->addActivite($subForm->getData());
            } elseif($subForm->isSubmitted()) {
                $rapportData['error'] = true;
                foreach($subForm->getErrors(true) as $error) {
                    $rapportData['error_where'][$name][] = (is_numeric($error->getOrigin()->getName()) ?
                        $error->getMessage() :
                        $error->getOrigin()->getName() . " : " . $error->getMessage())
                    ;
                }
            }
        }

        if($form->isSubmitted() && $form->isValid() && false  === $rapportData['error']) {
            $rapport->setVersion($rapport->getVersion()+1);

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
            'formAdministratif' => $forms['administratif']->createView(),
            'formFormation' => $forms['formation']->createView(),
            'activites' => $currentActivites,
            'rapport' => $rapportData,
        ]);
    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     *
     * @param LoggerInterface $logger
     *
     * @return Response
     */
    public function listForms(LoggerInterface $logger, EntityManagerInterface $em) {
        $month = date("m");
        $year = date("Y");

        try {
            $now = new DateTimeImmutable("01-".date("m")."-".date("Y"));
            $prevMonthDate = (new DateTime())->modify('previous month');
            $previousMonth = new DateTimeImmutable("01-".$prevMonthDate->format("m")."-".$prevMonthDate->format("Y"));
        } catch(\Exception $e) {
            $logger->critical("Fail to initialize date : ".$e->getCode());
            $this->addFlash("error", "Une erreur est survenue en tentant d'afficher la page, vous avez été redirigé⋅ sur la page d'accueil. ");
            return $this->redirectToRoute('home');
        }

        $metabaseSecretKey = $this->getParameter("metabase_key");
        $metabaseDbUrl = $this->getParameter("metabase_url");
        $metabaseDashboard = $this->getParameter("metabase_dashboard");

        $signer = new Sha256();
        $token = (new Builder())
            ->withClaim('resource', [
                'dashboard' => (int)$metabaseDashboard
            ])
            ->withClaim('params', (Object)null)
            ->issuedAt('iat', time())
            ->withClaim('_embedding_params', (Object)null)
            ->getToken($signer, new Key($metabaseSecretKey));

        $iframeUrl = $metabaseDbUrl."embed/dashboard/".$token."#bordered=true&titled=true";

        return $this->render('listForms.html.twig', [
            'iframeUrl' => $iframeUrl, 
            'now' => $now, 
            'previousMonth' => $previousMonth, 
            ]);

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
            $beforePrevDate = (clone $prevMonthDate)->modify('previous month');
            $prevMonth = new DateTimeImmutable("01-".$prevMonthDate->format("m")."-".$prevMonthDate->format("Y"));
            $beforePrevMonth = new DateTimeImmutable("01-".$beforePrevDate->format("m")."-".$beforePrevDate->format("Y"));
        } catch(\Exception $e) {
            $logger->critical("Fail to initialize date");
            $this->addFlash("error", "Une erreur est survenue en tentant d'afficher la page, vous avez été redirigé⋅ sur la page d'accueil. ");
            return $this->redirectToRoute('home');
        }
        
        $service = $this->getUser()->getService();
        $openMonths=[];
        if(!$em->getRepository("App:MoisClos")->isClosed($service, $beforePrevMonth)) {
            $openMonths[]=$beforePrevMonth;
        }
        if(!$em->getRepository("App:MoisClos")->isClosed($service, $prevMonth)) {
            $openMonths[]=$prevMonth;
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
            'date' => $prevMonth->format("d-m-Y"),
            'openMonths' => $openMonths
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
            if($nextMonth > new \DateTimeImmutable()) {
                $nextMonth = null;
            }
            $prevMonthDate = clone $date;
            $prevMonthDate->modify('previous month');
            $prevMonth = new DateTimeImmutable("01-".$prevMonthDate->format("m")."-".$prevMonthDate->format("Y"));
        } catch(\Exception $e) {
            $logger->critical("Fail to initialize date");
            $this->addFlash("error", "Une erreur est survenue en tentant d'afficher la page, vous avez été redirigé⋅e sur la page d'accueil. ");
            return $this->redirectToRoute('home');
        }
        $reports = $em->getRepository('App:Rapport')->findByPeriod(
            $date,
            $nextMonth,
            $userService,
            200);

        return $this->render('listReports.html.twig', [
            'reports' => $reports,
            'date' => $date,
            'nextDate' => $nextMonth ? $nextMonth->format("d-m-Y") : null,
            'prevDate' => $prevMonth->format("d-m-Y"),
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
    
    /**
     * @Route("/api/mois_clos", name="mois_clos", methods={"POST"})
     */
    public function newMoisClos(EntityManagerInterface $em, Request $request) {
        if(!$this->getUser()->getChefUlam()) {
            throw new AccessDeniedException('Erreur : seul⋅e⋅s les chef⋅fe⋅s d\'unité peuvent faire cela');
        }
        try {
            $dateString = $request->request->get('date');
            $service = $this->getUser()->getService();
        } catch (Exception $ex) {
            throw new InvalidArgumentException("La date est invalide ou l'utilisateur n'a pas de service");
        }
        
        $moisClos = new MoisClos();
        
        try {
            $date = new \DateTimeImmutable("01-".$dateString);
            $moisClos->setService($service)
                ->setDate($date);
        } catch (Exception $ex) {
            throw new InvalidArgumentException("La date est invalide ou l'utilisateur n'a pas de service");
        }
        
        $this->addFlash("success", "Le mois de ".$date->format("M")." est clos.");
        
        $em->persist($moisClos);
        $em->flush();
        
        return $this->json(['status' => "success"]);
    }

    private function makeTimeDivisionArray(RapportRepartitionHeures $rH) :array {
        return [
            'controleMer' => $rH->getControleMer() ? TimeConvert::minutesToTime($rH->getControleMer())->format("H:i") : null,
            'controleTerre' => $rH->getControleTerre() ? TimeConvert::minutesToTime($rH->getControleTerre())->format("H:i") : null,
            'controleAerien' => $rH->getControleAerien() ? TimeConvert::minutesToTime($rH->getControleAerien())->format("H:i") : null,
            'controleAireProtegeeMer' => $rH->getControleAireProtegeeMer() ? TimeConvert::minutesToTime($rH->getControleAireProtegeeMer())->format("H:i") : null,
            'controleAireProtegeeTerre' => $rH->getControleAireProtegeeTerre() ? TimeConvert::minutesToTime($rH->getControleAireProtegeeTerre())->format("H:i") : null,
            'controleAireProtegeeAerien' => $rH->getControleAireProtegeeAerien() ? TimeConvert::minutesToTime($rH->getControleAireProtegeeAerien())->format("H:i") : null,
            'controlePollutionMer' => $rH->getControlePollutionMer() ? TimeConvert::minutesToTime($rH->getControlePollutionMer())->format("H:i") : null,
            'controlePollutionTerre' => $rH->getControlePollutionTerre() ? TimeConvert::minutesToTime($rH->getControlePollutionTerre())->format("H:i") : null,
            'controlePollutionAerien' => $rH->getControlePollutionAerien() ? TimeConvert::minutesToTime($rH->getControlePollutionAerien())->format("H:i") : null,
            'controleEnvironnementMer' => $rH->getControleEnvironnementMer() ? TimeConvert::minutesToTime($rH->getControleEnvironnementMer())->format("H:i") : null,
            'controleEnvironnementTerre' => $rH->getControleEnvironnementTerre() ? TimeConvert::minutesToTime($rH->getControleEnvironnementTerre())->format("H:i") : null,
            'controleEnvironnementAerien' => $rH->getControleEnvironnementAerien() ? TimeConvert::minutesToTime($rH->getControleEnvironnementAerien())->format("H:i") : null,
            'controleChlordeconeTotalMer' => $rH->getControleChlordeconeTotalMer() ? TimeConvert::minutesToTime($rH->getControleChlordeconeTotalMer())->format("H:i") : null,
            'controleChlordeconeTotalTerre' => $rH->getControleChlordeconeTotalTerre() ? TimeConvert::minutesToTime($rH->getControleChlordeconeTotalTerre())->format("H:i") : null,
            'controleChlordeconePartielMer' => $rH->getControleChlordeconePartielMer() ? TimeConvert::minutesToTime($rH->getControleChlordeconePartielMer())->format("H:i") : null,
            'controleChlordeconePartielTerre' => $rH->getControleChlordeconePartielTerre() ? TimeConvert::minutesToTime($rH->getControleChlordeconePartielTerre())->format("H:i") : null,
            'controleCroise' => $rH->getControleCroise() ? TimeConvert::minutesToTime($rH->getControleCroise())->format("H:i") : null,
            'immigration' => $rH->getImmigration() ? TimeConvert::minutesToTime($rH->getImmigration())->format("H:i") : null,
            'visiteSecurite' => $rH->getVisiteSecurite() ? TimeConvert::minutesToTime($rH->getVisiteSecurite())->format("H:i") : null,
            'nombreVisiteSecurite' => $rH->getNombreVisiteSecurite(),
            'surveillanceManifestationMer' => $rH->getSurveillanceManifestationMer() ? TimeConvert::minutesToTime($rH->getSurveillanceManifestationMer())->format("H:i") : null,
            'surveillanceManifestationTerre' => $rH->getSurveillanceManifestationTerre() ? TimeConvert::minutesToTime($rH->getSurveillanceManifestationTerre())->format("H:i") : null,
            'surveillanceDpmMer' => $rH->getSurveillanceDpmMer() ? TimeConvert::minutesToTime($rH->getSurveillanceDpmMer())->format("H:i") : null,
            'surveillanceDpmTerre' => $rH->getSurveillanceDpmTerre() ? TimeConvert::minutesToTime($rH->getSurveillanceDpmTerre())->format("H:i") : null,
            'surete' => $rH->getSurete() ? TimeConvert::minutesToTime($rH->getSurete())->format("H:i") : null,
            'maintienOrdre' => $rH->getMaintienOrdre() ? TimeConvert::minutesToTime($rH->getMaintienOrdre())->format("H:i") : null,
            'assistance' => $rH->getAssistance() ? TimeConvert::minutesToTime($rH->getAssistance())->format("H:i") : null,
            'plongee' => $rH->getPlongee() ? TimeConvert::minutesToTime($rH->getPlongee())->format("H:i") : null,
        ];
    }

}
