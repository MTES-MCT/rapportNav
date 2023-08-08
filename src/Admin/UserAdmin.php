<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Service;

final class UserAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
                ->add('username')
                ->add('email')
                ->add('service')
                ->add('chefUlam')
                ->add('enabled')
                ->add('lastLogin')
                ->add('roles')
                ->add('agent')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
                ->addIdentifier('username')
                ->add('email')
                ->add('service')
                ->add('chefUlam')
                ->add('enabled')
                ->add('lastLogin')
                ->add('roles')
                ->add('agent')
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
                ->add('username')
                ->add('email')
                ->add('plainPassword', TextType::class)
                ->add('agent')
                ->add('service', ModelType::class, [
                    'class' => Service::class,
                    'property' => 'nom',
                ])
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'ROLE_ULAM' => 'ROLE_ULAM',
                        'ROLE_PAM' => 'ROLE_PAM',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                        'ROLE_GM' => 'ROLE_GM'
                    ],
                    'multiple' => true
                ])
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
            ->with('Informations de base')
                ->add('username')
                ->add('email')
                ->add('service')
                ->add('agent')
            ->end()
            ->with('Management')
                ->add('chefUlam')
                ->add('enabled', null, ['required' => false])
            ->end()
        ;
    }

}
