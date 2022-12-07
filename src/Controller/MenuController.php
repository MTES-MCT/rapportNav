<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{

        public function menu(ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->findAll();
        $mailto = 'mailto:';
        $recipients = [];
        $copys = [];

        foreach($contacts as $contact) {
            if($contact->getIsRecipient()) {
                $recipients[] = $contact->getEmail();
            }
            if($contact->getIsCopy()) {
                $copys[] = $contact->getEmail();
            }
        }

        foreach($recipients as $key => $recipient) {
            if($key > 0) {
                $mailto .= ",{$recipient}";
            } else {
                $mailto .= $recipient;
            }
        }

        foreach($copys as $key => $copy) {
            if($key > 0) {
                $mailto .= ",{$copy}";
            } else {
                $mailto .= "?cc=$copy";
            }
        }


        $menuList = [
            [
                'title' => 'Ajouter un rapport',
                'path' => $this->generateUrl('list_forms')
            ],
            [
                'title' => 'Voir les rapports',
                'path' => $this->generateUrl('list_submissions')
            ],
            [
                'title' => 'Suivi des indicateurs',
                'path' => $this->getParameter('metabase_root')
            ],
            [
                'title' => 'Documentation',
                'path' => '/documentation.pdf'
            ],
            [
                'title' => 'Contact',
                'path' => $mailto
            ],
        ];

        return $this->render('fragments/menu.html.twig', [
            'menuList' => $menuList
        ]);
    }

}
