<?php

namespace App\Form;

use App\Entity\MissionAdministratif;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionAdministratifType extends MissionType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('activite', TextareaType::class, [
                'required' => false,
                'label' => false,
            ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => MissionAdministratif::class,
            'service' => "",
        ]);
    }
}
