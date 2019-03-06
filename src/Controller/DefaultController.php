<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\Submission;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    /**
     * @Route("/show_form/{id}", name="show_form", requirements={"id": "\d+"})
     *
     * @param int                    $id
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showForm(int $id, EntityManagerInterface $em) {
        /** @var Form $form */
        $form = $em->getRepository('App:Form')->find($id);

        if(!$form) {
            throw $this->createNotFoundException("No form found");
        }

        return $this->render('form.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/submit/{id}", name="results", methods={"POST"}, requirements={"id": "\d+"})
     * @param int                    $id
     * @param Request                $request
     *
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception exception in case of error in \DateTime creation (no reason this happens in this precise situation)
     */
    public function results(int $id, Request $request, EntityManagerInterface $em) {
        /** @var Form $form */
        $form = $em->getRepository('App:Form')->find($id);

        if(!$form) {
            throw $this->createNotFoundException("No form found");
        }

        $data = json_decode($request->getContent(), true);

        $submission = new Submission();
        $submission->setLastEdition(new \DateTime())
            ->setRelatedForm($form)
            ->setData($data);
        $em->persist($submission);
        $em->flush();

        return $this->json(["status" => "success", "data" => ""]);
    }

    /**
     * @Route("/list_submissions/{id}", name="list_submissions", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function listSubmissions(EntityManagerInterface $em, int $id = null) {
        if(!is_null($id)) {
            /** @var Form $form */
            $form = $em->getRepository('App:Form')->find($id);
            $submissions = $em->getRepository('App:Submission')->findBy(['relatedForm' => $form]);
        } else {
            $submissions = $em->getRepository('App:Submission')->findBy([], ['relatedForm' => 'DESC']);
        }

        if(!$submissions || count($submissions) == 0) {
            return $this->render('base.html.twig');
        }

        return $this->render('list.html.twig', ['submissions' => $submissions]);

    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     */
    public function listForms(EntityManagerInterface $em) {
            /** @var Form[] $form */
            $forms = $em->getRepository('App:Form')->findAll();

        return $this->render('listForms.html.twig', ['forms' => $forms]);

    }
}
