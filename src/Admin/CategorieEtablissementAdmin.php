<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategorieEtablissementAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('complementDonnee')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->add('nom')
            ->add('complementDonnee')
            ;
    }

    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom', TextType::class)
            ->add('complementDonnee', TextType::class)
            ;
    }
}
