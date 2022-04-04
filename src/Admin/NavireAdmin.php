<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NavireAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom', TextType::class)
            ->add('immatriculation', TextType::class)
            ->add('longueurHorsTout', NumberType::class)
            ->add('genreNav')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('immatriculation')
            ->add('longueurHorsTout')
            ->add('genreNav')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('immatriculation')
            ->add('longueurHorsTout')
            ->add('genreNav')
        ;
    }

}