<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('lastLogin')
                ->add('roles')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('lastLogin')
                ->add('roles')
                ->add('chefUlam')
                ->add('service')
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
                ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', TextType::class)
                ->add('service')
            ->end()
            ->with('Management')
//                ->add('roles', null)
                ->add('chefUlam')
                ->add('enabled', null, ['required' => false])
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('lastLogin')
                ->add('roles')
        ;
    }

}
