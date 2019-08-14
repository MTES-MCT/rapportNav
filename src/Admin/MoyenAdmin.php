<?php


namespace App\Admin;


use App\Entity\MoyenTypeNavire;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MoyenAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('serviceProprietaire')
            ->add('terrestre')
            ->add('typeNavire', ModelType::class,
                ['class' => MoyenTypeNavire::class,
                    'property' => 'nom',
                    'required' => false])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nom')
            ->add('serviceProprietaire')
            ->add('terrestre')
            ->add('typeNavire')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('serviceProprietaire')
            ->addIdentifier('terrestre')
            ->addIdentifier('typeNavire')
        ;
    }

}