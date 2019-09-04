<?php

namespace App\Form;

use App\Entity\MissionAdministratif;
use App\Entity\MissionSecours;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionSecoursType extends MissionType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('dureeSecours', TimeType::class, [
                'required' => true,
                'widget' => "single_text",
                'label' => "Durée de la mission de sauvetage",
            ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => MissionSecours::class,
            'service' => "",
        ]);
    }
}
