<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MoyenAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Nautique' => 0,
                    'Terrestre' => 1,
                ],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de d'établissement"])
            ->add('posseseur', TextType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nom')
            ->add('type')
            ->add('possesseur')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('type')
            ->addIdentifier('possesseur')
        ;
    }

}