<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class RapportControleType extends RapportType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('methodeCiblage', ChoiceType::class, [
                'choices' => ['Ciblé via outil' => 0, 'Ciblé manuellement' => 1, 'Opportunité' => 3],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Méthode de contrôle"]);
    }
}