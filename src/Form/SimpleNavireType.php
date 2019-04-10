<?php

namespace App\Form;

use App\Entity\Navire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleNavireType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('immatriculation_fr', TextType::class, ['attr' => ['class' => "immatriculation_fr"]])
            ->add('nom', TextType::class, ['attr' => ['disabled' => ""]])
            ->add('longueurHorsTout', NumberType::class, ['attr' => ['disabled' => ""]])
            ->add('idNavFloteur', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }
}
