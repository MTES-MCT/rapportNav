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

class MoyenAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper): void {
        $formMapper
            ->add('nom', TextType::class, 
                ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('serviceProprietaire', ModelType::class, [
                'class' => Service::class,
                'property' => 'nom',
            ])
            ->add('terrestre')
            ->add('typeNavire', ModelType::class,
                ['class' => CategorieMoyen::class,
                    'property' => 'nom',
                    'required' => false])
            ->add('dateDebutService')
            ->add('dateFinService')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
        $datagridMapper
            ->add('nom')
            ->add('serviceProprietaire')
            ->add('terrestre')
            ->add('typeNavire')
            ->add('dateDebutService')
            ->add('dateFinService')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void {
        $listMapper
            ->addIdentifier('nom')
            ->add('serviceProprietaire')
            ->add('terrestre')
            ->add('typeNavire')
            ->add('dateDebutService')
            ->add('dateFinService')
        ;
    }

}