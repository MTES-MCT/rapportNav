<?php

namespace App\Controller;

use App\Entity\SuiviMensuel;
use App\Form\SuiviMensuelType;
use App\Repository\SuiviMensuelRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suivimensuel")
 */
class SuiviMensuelController extends AbstractController {
    /**
     * @Route("/{month}-{year}",
     *     requirements={"month"="0[0-9]|1[0-2]", "year"="\d+"},
     *     name="suivi_mensuel_edit",
     *     methods={"GET","POST"})
     * @param Request $request
     * @param int $month
     * @param int $year
     *
     * @return Response
     */
    public function new(Request $request, int $month, int $year): Response {
        $entityManager = $this->getDoctrine()->getManager();
        $service = $this->getUser()->getService();
        try {
            $date = new DateTimeImmutable($year."-".$month."-01");
        } catch(\Exception $e) {
            throw new NotFoundHttpException("Pas de rapport pour la date spécifiée, avez vous indiqué une date correcte ? ".$month."/".$year);
        }

        $suiviMensuel = $entityManager->getRepository(SuiviMensuel::class)
            ->findBy(['service' => $service, 'date' => $date]);

        if(1 < count($suiviMensuel)) {
            throw new HttpException(500, "More than one element found for this month...");
        }

        if(!$suiviMensuel || 1 > count($suiviMensuel)) {
            $suiviMensuel = new SuiviMensuel();
            $suiviMensuel
                ->setDate($date)
                ->setService($service);
        } else {
            $suiviMensuel = $suiviMensuel[0];
        }

        $form = $this->createForm(SuiviMensuelType::class, $suiviMensuel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suiviMensuel);
            $entityManager->flush();

            $this->addFlash("success", "Suivi mis à jour avec succès. ");

            return $this->redirectToRoute('home');
        }

        return $this->render('suivi_mensuel.html.twig', [
            'date' => $date,
            'form' => $form->createView(),
        ]);
    }
}
