<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Service;
use App\Entity\Rapport;


class RapportAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('serviceCreateur', ModelType::class, [
                'class' => Service::class,
                'property' => 'nom',
            ])
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
            ->add('id', null, ['label' =>"Numéro de rapport"])
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
            ->addIdentifier('id')
            ->add('serviceCreateur')
            ->add('dateDebutMission')
            ->add('dateFinMission')
            ->add('agents')
            ->add('arme')
            ->add('moyens')
            ->add('conjointe')
            ->add('serviceConjoints')
            ->add('commentaire')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }
    
    public function toString($rapport) {
        return $rapport instanceof Rapport ? "Rapport n°".$rapport->getId() : 'Rapport';
    }

}