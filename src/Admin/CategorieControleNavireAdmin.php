<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategorieControleNavireAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom', TextType::class, ['required' => true])
            ->add('isGMArmement', CheckboxType::class, ['required' => false])
            ->add('isGMArmementSousItem', CheckboxType::class, ['required' => false])
            ->add('isGMPersonnel', CheckboxType::class, ['required' => false])
            ->add('isGMPersonnelSousItem', CheckboxType::class, ['required' => false])
            ->add('active', CheckboxType::class, ['required' => false])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('isGMArmement')
            ->add('isGMPersonnel')
            ->add('isGMArmementSousItem')
            ->add('isGMPersonnelSousItem')
            ->add('active')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->addIdentifier('nom')
            ->add('isGMArmement')
            ->add('isGMPersonnel')
            ->add('isGMArmementSousItem')
            ->add('isGMPersonnelSousItem')
            ->add('active')
        ;
    }

}
