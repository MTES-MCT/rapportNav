<?php

namespace App\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController as SonataController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AgentCRUDController extends SonataController
{
    public function deleteAction($id): Response
    {
        $request = $this->getRequest();
        $id      = $request->get($this->admin->getIdParameter());
        $object  = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('Impossible de trouver l\'élément d\'identifiant : %s', $id));
        }
        
        $rapports = $this->getDoctrine()->getRepository("App:Rapport")->findAllWithAgent($id);
        
        if($rapports) {
            $this->addFlash(
                'sonata_flash_error',
                'Cet Agent a des Rapports qui lui sont liés, impossible de le supprimer, indiquez plutôt une date de départ de l\'équipe.'
                );
            
            return $this->redirectTo($object);
        }

        return parent::deleteAction($id);
    }

    public function batchActionDelete(ProxyQueryInterface $query): Response
    {
        $selectedAgents = $query->execute();

        foreach ($selectedAgents as $selectedAgent) {
            $rapports = $this->getDoctrine()->getRepository("App:Rapport")->findAllWithAgent($selectedAgent->getId());
            
            if($rapports) {
                $this->addFlash(
                    'sonata_flash_error',
                    'Cet Agent ' . $selectedAgent->getNom() . '(' . $selectedAgent->getId() . ') a des Rapports qui lui sont liés,' . 
                    'impossible de le supprimer, indiquez plutôt une date de départ de l\'équipe.'
                    );
                
                return new RedirectResponse(
                    $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
                    );
            }
        }

        return parent::batchActionDelete($query);
    }
}
