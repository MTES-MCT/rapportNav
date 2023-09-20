<?php

namespace App\Form\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
use App\Entity\Document;
use App\Entity\NavPro\ControleLot;
use App\Form\DocumentType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ControleLotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', IntegerType::class, [
                'label' => 'Nombre de contrôles documentaires',
                'label_attr' => ['class' => 'fr-label'],
                'attr' => ['class' => 'fr-input']
            ])
            ->add('pvEmis', CheckboxType::class, [
                'label' => 'PV émis',
                'required' => false,
                'label_attr' => ['class' => 'fr-label'],
                'attr' => ['class' => 'pv-emis-checkbox'],
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'fr-input',
                    'rows' => 10
                ],
                'label' => 'Commentaire et remarque sur ce contrôle',
                'label_attr' => ['class' => 'fr-label']
            ])
            ->add('controlesRealisesArmement', EntityType::class, [
                'class' => CategorieControleArmement::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (armement)',
                'label_attr' => ['class' => 'fr-label'],
                'choice_attr' => ['class' => 'fr-mb-2v']
            ])
            ->add('controlesRealisesPersonnel', EntityType::class, [
                'class' => CategorieControlePersonnel::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (personnel)',
                'label_attr' => ['class' => 'fr-label']
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControleLot::class,
        ]);
    }
}
