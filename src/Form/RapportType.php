<?php

namespace App\Form;

use App\Entity\Rapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('dateMission', DateType::class, ['required' => true, 'label' => "Date de la mission"])
            ->add('typeRapport', ChoiceType::class, [
                'choices' => ['Ciblé' => 0, 'Ciblé manuellement' => 1, 'Aléatoire' => 2, 'Opportunité' => 3],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de contrôle"])
            ->add('agents', null, [
                'multiple' => true,
                'expanded' => true,
                'label' => "Agents embauchés sur la mission"])
            ->add('lieuMission', ChoiceType::class, [
                'choices' => ['Mer' => 0, 'Terre' => 1],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Lieu de la mission"])
            ->add('zoneMission', ChoiceType::class, [
                'choices' => ['Rade LO' => 0, 'Groix et courreaux' => 1, 'Rives Etel' => 2, 'Ouest Quiberon' => 3],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Zone de la mission"])
            ->add('dureeMission', IntegerType::class, [
                'required' => true,
                'label' => "Durée de la mission (en minutes)"])
            ->add('moyens', null, [
                'multiple' => true,
                'expanded' => true,
                'label' => "Moyens utilisés"])
            ->add('navires', CollectionType::class, [
                'entry_type' => SimpleRapportNavireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('commentaire', null, [
                'label' => "Commentaires et remarques (pour note interne)"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
