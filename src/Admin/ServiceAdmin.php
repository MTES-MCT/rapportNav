<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\ZoneGeographique;

final class ServiceAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('zoneGeographique')
            ->add('quadrigramme')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->addIdentifier('nom')
            ->add('zoneGeographique')
            ->add('quadrigramme')
            ->add('_action', null, [
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
            ->add('nom')
            ->add('zoneGeographique', ModelType::class, [
                'class' => ZoneGeographique::class,
                'property' => 'nom',
                'required' => false,
            ])
            ->add('quadrigramme')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
            ->add('nom')
            ->add('zoneGeographique')
            ->add('quadrigramme')
            ;
    }
}
