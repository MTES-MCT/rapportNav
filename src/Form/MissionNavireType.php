<?php

namespace App\Form;

use App\Entity\Rapport;
use App\Entity\TypeMissionControle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionNavireType extends MissionType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('typeMissionControle', EntityType::class, [
                'class' => TypeMissionControle::class,
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de mission"])
            ->add('navires', CollectionType::class, [
                'entry_type' => ControleNavireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "",
        ]);
    }
}
