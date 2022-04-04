<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Service;
use App\Entity\Rapport;


class RapportAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper): void {
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

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void {
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

    protected function configureListFields(ListMapper $listMapper): void {
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
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper): void {
        $showMapper
        ->add('id')
        ->add('serviceCreateur')
        ->add('dateDebutMission')
        ->add('dateFinMission')
        ->add('agents')
        ->add('arme')
        ->add('moyens')
        ->add('conjointe')
        ->add('serviceConjoints')
        ->add('commentaire')
        ;
    }
    
    public function toString($rapport): string {
        return $rapport instanceof Rapport ? "Rapport n°".$rapport->getId() : 'Rapport';
    }

}