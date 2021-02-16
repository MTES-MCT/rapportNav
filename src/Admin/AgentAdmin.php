<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Service;


final class AgentAdmin extends AbstractAdmin {
    
    public function toString($object): ?string {
        return $object instanceof \App\Entity\Agent ? $object->__toString() : 'Agent';
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('service')
            ->add('dateArrivee')
            ->add('dateDepart')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->add('nom')
            ->add('prenom')
            ->add('service.nom')
            ->add('dateArrivee')
            ->add('dateDepart')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom')
            ->add('prenom')
            ->add('service', ModelType::class, [
                'class' => Service::class,
                'property' => 'nom',
            ])
            ->add('dateArrivee')
            ->add('dateDepart')
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
        ->add('nom')
        ->add('prenom')
        ->add('service')
        ->add('dateArrivee')
        ->add('dateDepart')
        ;
    }
}
