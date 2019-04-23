<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EtablissementAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Marché plaisance : concessionnaire' => 0,
                    'Culture marine' => 1,
                    'Site de débarquement' => 2,
                    'Criée' => 3,
                    'Commerce à terre' => 4,
                    'Mareyeur' => 5,
                    'contrôle routier' => 6,
                    'Formation à la conduite mer et eaux intérieures' => 7,
                    'autre' => 8],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de d'établissement"])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nom')
            ->add('type')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('type')
        ;
    }

}