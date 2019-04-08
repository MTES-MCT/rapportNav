<?php

namespace App\Form;

use App\Entity\ControlePeche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlePecheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateMission')
            ->add('typeControle', ChoiceType::class, ['choices' => ['Ciblé' => 0, 'Ciblé manuellement' => 1, 'Aléatoire' => 2, 'Opportunité' => 3], 'multiple' => false, 'expanded' => false])
            ->add('agents', null, ['multiple' => true, 'expanded' => true])
            ->add('lieuMission', ChoiceType::class, ['choices' => ['Mer' => 0, 'Terre' => 1], 'multiple' => false, 'expanded' => false])
            ->add('zoneMission', ChoiceType::class, ['choices' => ['Rade LO' => 0, 'Groix et courreaux' => 1, 'Rives Etel' => 2, 'Ouest Quiberon' => 3], 'multiple' => false, 'expanded' => false])
            ->add('dureeMission', NumberType::class)
            ->add('moyens', null, ['multiple' => true, 'expanded' => true])
            ->add('commentaire')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ControlePeche::class,
        ]);
    }
}
