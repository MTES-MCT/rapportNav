<?php


namespace App\Admin;


use App\Entity\Moyen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('methodeCiblage', ChoiceType::class)
            ->add('agents', null)
//            ->add('typeMission', ChoiceType::class)
//            ->add('aireMarineSpeciale', ChoiceType::class)
            ->add('lieuMission', ChoiceType::class)
            ->add('zoneMission', ChoiceType::class)
            ->add('arme', CheckboxType::class)
            ->add('moyens', ModelType::class, [
                'class' => Moyen::class,
                'property' => 'nom',
            ])
            ->add('distanceTerrestre', IntegerType::class)
//            ->add('navires', ModelType::class, [
//                'class' => Navire::class,
//                'property' => 'immatriculation',
//            ])
            ->add('commentaire', TextareaType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('serviceCreateur')
            ->add('dateDebutMission')
            ->add('dateFinMission')
            ->add('methodeCiblage')
            ->add('agents')
//            ->add('typeMission')
//            ->add('aireMarineSpeciale')
            ->add('lieuMission')
            ->add('zoneMission')
            ->add('arme')
            ->add('moyens')
//            ->add('distanceTerrestre')
//            ->add('navires')
            ->add('commentaire')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('serviceCreateur')
            ->addIdentifier('dateDebutMission')
            ->addIdentifier('dateFinMission')
            ->addIdentifier('methodeCiblage')
            ->addIdentifier('agents')
//            ->addIdentifier('typeMission')
//            ->addIdentifier('aireMarineSpeciale')
            ->addIdentifier('lieuMission')
            ->addIdentifier('zoneMission')
            ->addIdentifier('arme')
            ->addIdentifier('moyens')
//            ->addIdentifier('distanceTerrestre')
//            ->addIdentifier('navires')
            ->addIdentifier('commentaire')
        ;
    }

}