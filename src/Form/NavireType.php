<?php

namespace App\Form;

use App\Entity\CategorieUsageNavire;
use App\Entity\Navire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NavireType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('immatriculation_fr', TextType::class, [
                'attr' => ['class' => "immatriculation_fr"],
                'label' => "Immatriculation du navire"])
            ->add('etranger', CheckboxType::class, [
                'required' => false,
                'label' => "Navire étranger"
            ])
            ->add('pavillon', TextType::class, [
                'required' => true,
                'label' => "Pavillon du navire"
            ])
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => "Nom du navire"])
            ->add('longueurHorsTout', NumberType::class, [
                'required' => false,
                'label' => "Longueur"])
            ->add('typeUsage', TextType::class, [
                'required' => false,
                'label' => "Genre de navigation"])
            ->add('categorieUsageNavire', EntityType::class, [
                'required' => true,
                'class' => CategorieUsageNavire::class,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => "Sélectionnez une catégorie",
                'choice_label' => "nom",
                'label' => "Catégorie du navire contrôlé"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }
}
