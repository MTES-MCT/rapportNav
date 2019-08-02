<?php


namespace App\Form;


use App\Entity\RapportMethodeCiblage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class RapportControleType extends RapportType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('methodeCiblage', EntityType::class, [
                'class' => RapportMethodeCiblage::class,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Méthode de contrôle"]);
    }
}