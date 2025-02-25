<?php

namespace App\Form\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
use App\Entity\Navire;
use App\Entity\NavPro\ControleUnitaire;
use App\Form\DocumentType;
use App\Form\NavireNavProType;
use App\Form\NavireType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleUnitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pvEmis', CheckboxType::class, [
                'label' => 'PV émis ?',
                'label_attr' => ['class' => 'fr-toggle__label'],
                'required' => false,
                'attr' => [
                    'class' => 'pv-emis-checkbox fr-toggle__input',
                    'aria-describedBy' => 'controle_unitaire_pvEmis-hint-text'
                    ]
            ])
            ->add('navireEtranger', CheckboxType::class, [
                'required' => false,
                'label' => 'Navire étranger',
                'label_attr' => ['class' => 'fr-label'],
            ])
            ->add('navire', EntityType::class, [
                'placeholder' => 'Immatriculation',
                'label' => 'Enregistrement du navire',
                'label_attr' => ['class' => 'fr-label'],
                'attr' => ['class' => 'fr-input fr-input-enregistrement'],
                'class' => Navire::class,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.immatriculation', 'ASC');
                }
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => 'Commentaire et remarque sur ce contrôle',
                'label_attr' => ['class' => 'fr-label'],
                'attr' => [
                    'class' => 'fr-input',
                    'rows' => 10
                ]
            ])
            ->add('controleRealisesArmement', EntityType::class, [
                'class' => CategorieControleArmement::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (armement)',
                'label_attr' => ['class' => 'fr-label'],
                'choice_attr' => function ($choice, string $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'test'];
                },
              'required' => false
            ])
            ->add('controleRealisesGM', EntityType::class, [
                'class' => CategorieControlePersonnel::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (gens de mer)',
                'label_attr' => ['class' => 'fr-label'],
                'required' => false
            ])
            ->add('date', DateType::class, [
                'attr' => ['class' => 'fr-input'],
                'widget' => 'single_text',
                'label' => 'Date du contrôle',
                'label_attr' => ['class' => 'fr-label']
            ])
            ->add('nbPv', IntegerType::class, [
                'attr' => ['class' => 'fr-input input-nb-pv'],
                'label' => 'Nombre de procès verbaux émis',
                'label_attr' => ['class' => 'fr-label'],
                'required' => false
            ])
            ->add('documents', CollectionType::class, [
                'entry_type' => DocumentType::class,
                'by_reference' => false,
                'allow_add' => true,
                'prototype' => true
            ])
          ->add('nouveauNavire', NavireNavProType::class, [
            'mapped' => false,
            'label' => false,
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControleUnitaire::class,
        ]);
    }
}
