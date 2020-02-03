<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CategorieControleNavireAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->add('nom')
            ;
    }

    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
            ->add('nom')
        ;
    }
}
