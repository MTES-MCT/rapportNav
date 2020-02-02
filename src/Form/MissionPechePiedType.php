<?php

namespace App\Form;

use App\Entity\MissionPechePied;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionPechePiedType extends MissionType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('controlePlaisanceSansPv', ControlePecheurPiedSansPvType::class)
            ->add('controleProSansPv', ControlePecheurPiedSansPvType::class)
            ->add('pecheursPied', CollectionType::class, [
                'entry_type' => ControlePecheurPiedType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => MissionPechePied::class,
            'service' => "",
        ]);
    }
}
