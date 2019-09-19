<?php

namespace App\Form;

use App\Entity\MissionNavire;
use App\Entity\TypeMissionControle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionNavireType extends MissionType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('typeMissionControle', EntityType::class, [
                'class' => TypeMissionControle::class,
                'required' => true,
                'multiple' => false,
                'expanded' => true,
                'placeholder' => '',
                //This is not pretty and should be in a template file but seems not possible so...
                'choice_attr' => function() { return ['v-model' => "missions['navire'].typeMissionControle"];},
                'label' => "Type d'activité"])
            ->add('aireMarine', TextType::class, ['required' => false, 'label' => "Nom de l'aire marine"])
            ->add('navires', CollectionType::class, [
                'entry_type' => ControleNavireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'prototype' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => MissionNavire::class,
            'service' => "",
        ]);
    }
}
