<?php

namespace App\Form;

use App\Entity\Navire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleNavireType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('immatriculation_fr', TextType::class, [
                'attr' => ['class' => "immatriculation_fr"],
                'label' => "Immatriculation du navire"])
            ->add('nom', TextType::class, [
                'attr' => ['readonly' =>  true],
            'label' => "Nom du navire (se complète automatiquement)"])
            ->add('longueurHorsTout', NumberType::class, [
                'attr' => ['readonly' => true],
                'label' => "Longueur (se complète automatiquement)"])
            ->add('typeUsage', ChoiceType::class, [
                'choices' => [
                    'Pêche professionnelle' => 0,
                    'Conchylicole' => 1,
                    'Navire école' => 2,
                    'Commerce à passager' => 3,
                    'Pêche dormant' => 4,
                    'Plaisance professionnelle' => 5,
                    'Plaisance non professionnelle' => 6],
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'placeholder' => '',
                'label' => "Navire à usage"])
            ->add('idNavFloteur', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }
}
