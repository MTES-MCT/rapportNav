<?php


namespace App\Admin;


use App\Entity\Moyen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RapportAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('serviceCreateur', TextType::class)
            ->add('dateDebutMission', DateType::class)
            ->add('dateFinMission', DateType::class)
            ->add('agents')
            ->add('arme', CheckboxType::class, ['required' => false])
            ->add('moyens')
            ->add('conjointe')
            ->add('serviceConjoints')
            ->add('commentaire', TextareaType::class, ['required' => false]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('serviceCreateur')
            ->add('dateDebutMission')
            ->add('dateFinMission')
            ->add('agents')
            ->add('arme')
            ->add('moyens')
            ->add('conjointe')
            ->add('serviceConjoints')
            ->add('commentaire');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('serviceCreateur')
            ->addIdentifier('dateDebutMission')
            ->addIdentifier('dateFinMission')
            ->addIdentifier('agents')
            ->addIdentifier('arme')
            ->add('moyens')
            ->add('conjointe')
            ->add('serviceConjoints')
            ->addIdentifier('commentaire');
    }

}