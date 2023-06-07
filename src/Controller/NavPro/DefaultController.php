<?php

namespace App\Controller\NavPro;

use App\Entity\NavPro\ControleLot;
use App\Form\NavPro\ControleLotType;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Handler\IFTTTHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/navpro", name="app_navpro_accueil" )
     */
    public function accueil()
    {
        return $this->render("navPro/accueil.html.twig");
    }


    /**
     * @Route("/navpro/controle/lot", name="app_navpro_default_ajoutcontroleparlot")
     */
    public function ajoutControleParLot(Request $request, EntityManagerInterface $em)
    {
        $type = $request->query->get('type');
        $titrePage = null;
        switch($type) {
            case ControleLot::TYPE_CONTROLE_ADMINISTRATIF_LOT:
                $titrePage = 'administratif par lot';
                break;

            case ControleLot::TYPE_CONTROLE_TERRAIN_MER_LOT:
                $titrePage = 'terrain (en mer) par lot';
                break;

            case ControleLot::TYPE_CONTROLE_TERRAIN_QUAI_LOT:
                $titrePage = 'terrain (à quai) par lot';
                break;
        }

        if(!$titrePage) {
            return $this->redirectToRoute('app_navpro_accueil');
        }

        $controleLot = new ControleLot();
        $controleLot->setType($type);
        $form = $this->createForm(ControleLotType::class, $controleLot);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controleLot);
            $em->flush();
            return new Response("Ok");
        }
        return $this->render("navPro/controle_lot.html.twig", [
            'form' => $form->createView(),
            'titrePage' => $titrePage
        ]);
    }

}
