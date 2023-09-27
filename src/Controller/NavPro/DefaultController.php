<?php

namespace App\Controller\NavPro;

use App\Entity\NavPro\ControleLot;
use App\Entity\NavPro\ControleUnitaire;
use App\Form\NavPro\ControleLotType;
use App\Form\NavPro\ControleUnitaireType;
use App\Repository\NavPro\ControleLotRepository;
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
    public function accueil(ControleUnitaireRepository $controleUnitaireRepository, ControleLotRepository $controleLotRepository)
    {
        return $this->render("navPro/accueil.html.twig", [
            'contrUnitaires' => $controleUnitaireRepository->findBy(['createdBy' => $this->getUser()->getService()]),
            'contrLots' => $controleLotRepository->findBy(['createdBy' => $this->getUser()->getService()])
        ]);
    }


    /**
     * @Route("/navpro/controle/lot", name="app_navpro_default_ajoutcontroleparlot")
     */
    public function ajoutControleParLot(Request $request, EntityManagerInterface $em)
    {

        $controleLot = new ControleLot();
        $controleLot->setCreatedBy($this->getUser()->getService());
        $form = $this->createForm(ControleLotType::class, $controleLot);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($request->query->get('brouillon')) {
                $controleLot->setBrouillon(true);
            } else {
                $controleLot->setBrouillon(false);
            }
            $em->persist($controleLot);
            $em->flush();
            $this->addFlash('success', "Le contrôle du " . $controleLot->getDate()->format('d/m/Y') . " a bien été enregistré.");
            return $this->redirectToRoute('app_navpro_accueil');
        }
        return $this->render("navPro/controle_lot.html.twig", [
            'form' => $form->createView(),
            'titrePage' => 'Contrôle administratif par lot',
            'brouillon' => true,
            'action' => $this->generateUrl('app_navpro_default_ajoutcontroleparlot')
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
        $controleUnitaire->setCreatedBy($this->getUser()->getService());
        $controleUnitaire->setType($type);
        $form = $this->createForm(ControleUnitaireType::class, $controleUnitaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($request->query->get('brouillon')) {
                $controleUnitaire->setBrouillon(true);
            } else {
                $controleUnitaire->setBrouillon(false);
            }
            $em->persist($controleUnitaire);
            $em->flush();
            $this->addFlash('success', "Le contrôle du " . $controleUnitaire->getDate()->format('d/m/Y') . " a bien été enregistré.");
            return $this->redirectToRoute('app_navpro_accueil');
        }

        return $this->render('navPro/controle_unitaire.html.twig', [
            'titrePage' => $titrePage,
            'form' => $form->createView(),
            'brouillon' => true,
            'action' => $this->generateUrl('app_navpro_default_ajoutcontrole_unitaire', [
                'type' => $type,
            ])
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
            if($request->query->get('brouillon')) {
                $controleUnitaire->setBrouillon(true);
            } else {
                $controleUnitaire->setBrouillon(false);
            }
            $em->persist($controleUnitaire);
            $em->flush();
            $this->addFlash('success', "Le contrôle du " . $controleUnitaire->getDate()->format('d/m/Y') . " a bien été enregistré.");
            return $this->redirectToRoute('app_navpro_accueil');
        }

        return $this->render('navPro/controle_unitaire.html.twig', [
            'titrePage' => $titrePage,
            'form' => $form->createView(),
            'brouillon' => $controleUnitaire->getBrouillon(),
            'action' => $this->generateUrl('app_navpro_default_modif_controle_unitaire', [
                'id' => $controleUnitaire->getId()
            ])
        ]);
    }


    /**
     * @Route("/navpro/controle/lot/{id}", name="app_navpro_default_modif_controle_lot")
     */
    public function modifControleLot(ControleLot $controleLot, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(ControleLotType::class, $controleLot);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($request->query->get('brouillon')) {
                $controleLot->setBrouillon(true);
            } else {
                $controleLot->setBrouillon(false);
            }
            $em->flush();
            $this->addFlash('success', "Le contrôle du " . $controleLot->getDate()->format('d/m/Y') . " a bien été enregistré.");
            return $this->redirectToRoute('app_navpro_accueil');
        }

        return $this->render('navPro/controle_lot.html.twig', [
            'titrePage' => 'Contrôle administratif par lot',
            'form' => $form->createView(),
            'brouillon' => $controleLot->getBrouillon(),
            'action' => $this->generateUrl('app_navpro_default_modif_controle_lot', [
                'id' => $controleLot->getId()
            ])
        ]);
    }


}
