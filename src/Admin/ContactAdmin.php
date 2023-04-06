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


final class ContactAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('isRecipient')
            ->add('isCopy')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('isRecipient')
            ->add('isCopy')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('isRecipient')
            ->add('isCopy')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('isRecipient')
            ->add('isCopy')
        ;
    }
}
