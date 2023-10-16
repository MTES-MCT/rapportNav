<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\PAM\PamDatePlanning;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Service;

final class PamPlanningAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
                ->add('service')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
                ->addIdentifier('service')
                ->add('email')
                ->add('dateDebut')
                ->add('dateFin')
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
                ->add('email')
                ->add('service', ModelType::class, [
                    'class' => Service::class,
                    'property' => 'nom',
                ])
                ->add('dateDebut')
                ->add('dateFin')
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
                ->add('email')
                ->add('service')
                ->add('dateDebut')
                ->add('dateFin')
            ->end()
        ;
    }

}
