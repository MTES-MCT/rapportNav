<?php

namespace App\Form;

use App\Entity\RapportFormation;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportFormationType extends RapportType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('formation', TextareaType::class, [
                'required' => false,
                'label' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportFormation::class,
            'service' => "",
        ]);
    }
}
