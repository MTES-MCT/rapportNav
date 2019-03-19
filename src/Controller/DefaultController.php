<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\Submission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }


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
     * @Route("/submit/{form_id}/{submission_id}", name="results", methods={"POST"},
     *     requirements={"form_id": "\d+", "submission_id": "\d+"})
     * @param Request                $request
     *
     * @param EntityManagerInterface $em
     *
     * @param int                    $form_id
     * @param int|null               $submission_id
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception exception in case of error in \DateTime creation (no reason this happens in this precise
     *                    situation)
     */
    public function results(Request $request, EntityManagerInterface $em, int $form_id, int $submission_id = null) {
        /** @var Form $form */
        $form = $em->getRepository('App:Form')->find($form_id);

        if(!$form) {
            throw $this->createNotFoundException("No form found");
        }

        $data = json_decode($request->getContent());

        if(is_null($submission_id)) {
            $submission = new Submission();
            $submission->setLastEdition(new \DateTime())
                ->setRelatedForm($form)
                ->setData($data);
                $em->persist($submission);
        } else {
            /** @var Submission $submission */
            $submission = $em->getRepository('App:Submission')->find($submission_id);
            if(!$submission) {
                throw $this->createNotFoundException("No submission found");
            }
            $submission->setLastEdition(new \DateTime())
                ->setData($data);
        }
        $em->flush();

        return $this->json(["status" => "success", "data" => ""]);
    }

    /**
     * @Route("/list_submissions/{id}", name="list_submissions", methods={"GET"}, requirements={"id": "\d+"})
     * @param EntityManagerInterface $em
     * @param int|null               $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
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

        return $this->render('listSubmissions.html.twig', ['submissions' => $submissions]);

    }

    /**
     * @Route("/edit_submission/{id}", name="edit_submission", methods={"GET"}, requirements={"id": "\d+"})
     * @param EntityManagerInterface $em
     * @param int                    $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editSubmission(EntityManagerInterface $em, int $id) {
        /** @var Submission $submission */
        $submission = $em->getRepository('App:Submission')->find($id);

        if(!$submission) {
            throw $this->createNotFoundException("Submission not found");
        }

        return $this->render('form.html.twig', ['form' => $submission->getRelatedForm(), 'submission' => $submission]);

    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listForms(EntityManagerInterface $em) {
        /** @var Form[] $form */
        $forms = $em->getRepository('App:Form')->findAll();

        return $this->render('listForms.html.twig', ['forms' => $forms]);

    }
}
