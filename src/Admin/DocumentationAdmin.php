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
use Symfony\Component\Form\Extension\Core\Type\FileType;


final class DocumentationAdmin extends AbstractAdmin {

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('version')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->add('path')
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
            ->add('file', FileType::class)
            ->add('version')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
            ->add('path')
            ->add('version')
        ;
    }
}
