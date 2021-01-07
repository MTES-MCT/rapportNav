<?php

namespace App\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController as SonataController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserCRUDController extends SonataController
{
    public function deleteAction($id)
    {
        $request = $this->getRequest();
        $id      = $request->get($this->admin->getIdParameter());
        $object  = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('Impossible de trouver l\'élément d\'identifiant : %s', $id));
        }
        
        $currentUserId = $this->getUser()->getId(); // ID of the current user
        if ($currentUserId == $id) {
            $this->addFlash(
                'sonata_flash_error',
                'Vous ne pouvez pas supprimer voter compte.'
                );
            
            return $this->redirectTo($object);
        }
        
        $rapportsUpdated = $this->getDoctrine()->getRepository("App:Rapport")->findBy(['updatedBy' => $id], null, 1);
        $rapportsCreated = $this->getDoctrine()->getRepository("App:Rapport")->findBy(['createdBy' => $id], null, 1);
        
        if($rapportsCreated || $rapportsUpdated) {
            $this->addFlash(
                'sonata_flash_error',
                'Cet utilisateur a des Rapports qui lui sont liés, impossible de le supprimer, désactivez plutôt le compte.'
                );
            
            return $this->redirectTo($object);
        }

        return parent::deleteAction($id);
    }

    public function batchActionDelete(ProxyQueryInterface $query)
    {
        $currentUserId = $this->getUser()->getId(); // ID of the current user
        $selectedUsers = $query->execute();

        
        
        foreach ($selectedUsers as $selectedAgent) {
            if ($selectedAgent->getId() == $currentUserId) {
                $this->addFlash(
                    'sonata_flash_error',
                    'Vous ne pouvez pas supprimer voter compte.'
                );

                return new RedirectResponse(
                    $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
                );
            }
            
            $rapports = $this->getDoctrine()->getRepository("App:Rapport")->findBy(['updatedBy' => $selectedAgent->getId()], null, 1);
            $rapports = $this->getDoctrine()->getRepository("App:Rapport")->findBy(['createdBy' => $selectedAgent->getId()], null, 1);
            
            if($rapports) {
                $this->addFlash(
                    'sonata_flash_error',
                    'Cet utilisateur ' . $selectedAgent->getUsername() . '(' . $selectedAgent->getId() . ') a des Rapports qui lui sont liés,' .
                    'impossible de le supprimer, désactivez plutôt le compte.'
                    );
                
                return new RedirectResponse(
                    $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
                    );
            }
        }

        return parent::batchActionDelete($query);
    }
}
