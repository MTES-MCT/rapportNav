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

final class CommandantAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
                ->add('agent')
                ->add('service')
                ->add('intitule')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
                ->addIdentifier('id')
                ->add('agent')
                ->add('service')
                ->add('intitule')
                ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
            ;
    }

    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
                ->with('Informations de base')
                ->add('agent')
                ->add('service', ModelType::class, [
                    'class' => Service::class,
                    'property' => 'nom',
                ])
            ->add('intitule')
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
            ->with('Informations de base')
                ->add('service')
                ->add('agent')
                ->add('intitule')
            ->end()
        ;
    }

}
