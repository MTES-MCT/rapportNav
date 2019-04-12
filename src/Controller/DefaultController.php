<?php

namespace App\Controller;

use App\Entity\ControleNavire;
use App\Entity\ControlePeche;
use App\Form\ControlePecheType;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use \Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }

    /**
     * @Route("/controle_peche", name="controle_des_peches")
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse|Response
     */
    public function rapportControlePeche(Request $request, EntityManagerInterface $em) {
        $controle = new ControlePeche();

        $form = $this->createForm(ControlePecheType::class, $controle);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controle);
            $em->flush();
            return $this->redirectToRoute('list_forms');
        }

        //Setting default values on new form
        if(!$form->isSubmitted()) {

            $form->get('navires')->setData([new ControleNavire()]);
        }
        try {
            $form->get('dateMission')->setData(new DateTime());
        } catch(Exception $e) {
        }

        dump($controle);

        return $this->render('controlePeche.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/controle_peche/edit/{id_edit}", name="edit_controle_des_peches", requirements={"id_edit": "\d+"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @param int|null               $id_edit
     *
     * @return RedirectResponse|Response
     */
    public function editRapportControlePeche(Request $request, EntityManagerInterface $em, int $id_edit = null) {
        if(null === $controle = $em->getRepository(ControlePeche::class)->find($id_edit)) {
            throw $this->createNotFoundException('Pas de controle trouvé avec cet identifiant '.$id_edit);
        }

        $currentNavires = new ArrayCollection();

        foreach($controle->getNavires() as $navire) {
            $currentNavires->add($navire);
        }

        $editForm = $this->createForm(ControlePecheType::class, $controle);

        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
            foreach($currentNavires as $navire) {
                if(false === $controle->getNavires()->contains($navire)) {
                    $em->remove($navire);
                }
            }

            $em->persist($controle);
            $em->flush();

            return $this->redirectToRoute('edit_controle_des_peches', ['id_edit' => $id_edit]);
        }

        return $this->render('controlePeche.html.twig', ['form' => $editForm->createView()]);
    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listForms(EntityManagerInterface $em) {

        return $this->render('listForms.html.twig');

    }

    /**
     * @Route("/list_submissions", name="list_submissions", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listSubmission(EntityManagerInterface $em) {

        return $this->render('listSubmissions.html.twig');

    }

    /**
     * @Route("/show_kpi", name="show_kpi", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function showKpi(EntityManagerInterface $em) {

        return $this->render('listSubmissions.html.twig');

    }
}
