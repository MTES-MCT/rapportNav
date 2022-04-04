<?php


namespace App\Admin;


use App\Entity\CategorieMoyen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Service;

class MoisClosAdmin extends AbstractAdmin {
    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
        ->add('date')
        ->add('service')
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
            ->add('date')
            ->add('service', ModelType::class, [
                'class' => Service::class,
                'property' => 'nom',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('date')
            ->add('service')
        ;
    }
}