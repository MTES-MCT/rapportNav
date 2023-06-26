<?php

namespace App\Controller\NavPro;

use App\Entity\NavPro\ControleLot;
use App\Entity\NavPro\ControleUnitaire;
use App\Form\NavPro\ControleLotType;
use App\Form\NavPro\ControleUnitaireType;
use App\Repository\NavPro\ControleUnitaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/navpro", name="app_navpro_accueil" )
     */
    public function accueil(ControleUnitaireRepository $controleUnitaireRepository)
    {
        return $this->render("navPro/accueil.html.twig", [
            'contrUnitaires' => $controleUnitaireRepository->findAll()
        ]);
    }


    /**
     * @Route("/navpro/controle/lot", name="app_navpro_default_ajoutcontroleparlot")
     */
    public function ajoutControleParLot(Request $request, EntityManagerInterface $em)
    {
        $controleLot = new ControleLot();
        $form = $this->createForm(ControleLotType::class, $controleLot);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controleLot);
            $em->flush();
            return new Response("Ok");
        }
        return $this->render("navPro/controle_lot.html.twig", [
            'form' => $form->createView(),
            'titrePage' => 'administratif par lot'
        ]);
    }

    /**
     * @Route("/navpro/controle/unitaire", name="app_navpro_default_ajoutcontrole_unitaire")
     */
    public function ajoutControleUnitaire(Request $request, EntityManagerInterface $em)
    {
        $type = $request->query->get('type');
        $titrePage = null;
        switch($type) {
            case ControleUnitaire::TYPE_CONTROLE_ADMINISTRATIF:
                $titrePage = 'administratif unitaire';
                break;
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_MER:
                $titrePage = 'terrain en mer unitaire';
                break;
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_QUAI:
                $titrePage = 'terrain à quai unitaire';
                break;

        }

        if(!$titrePage) {
            return $this->redirectToRoute('app_navpro_accueil');
        }

        $controleUnitaire = new ControleUnitaire();
        $controleUnitaire->setType($type);
        $form = $this->createForm(ControleUnitaireType::class, $controleUnitaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controleUnitaire);
            $em->flush();
            return new Response('ok');
        }

        return $this->render('navPro/controle_unitaire.html.twig', [
            'titrePage' => $titrePage,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/navpro/controle/unitaire/{id}", name="app_navpro_default_modif_controle_unitaire")
     */
    public function modifControleUnitaire(ControleUnitaire $controleUnitaire, Request $request, EntityManagerInterface $em)
    {
        $titrePage = null;
        switch($controleUnitaire->getType()) {
            case ControleUnitaire::TYPE_CONTROLE_ADMINISTRATIF:
                $titrePage = 'administratif unitaire';
                break;
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_MER:
                $titrePage = 'terrain en mer unitaire';
                break;
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_QUAI:
                $titrePage = 'terrain à quai unitaire';
                break;

        }

        $form = $this->createForm(ControleUnitaireType::class, $controleUnitaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controleUnitaire);
            $em->flush();
            return new Response('ok');
        }

        return $this->render('navPro/controle_unitaire.html.twig', [
            'titrePage' => $titrePage,
            'form' => $form->createView()
        ]);
    }

}
