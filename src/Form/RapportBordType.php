<?php

namespace App\Form;

use App\Entity\Rapport;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportBordType extends RapportControleType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('aireMarineSpeciale', ChoiceType::class, [
                'choices' => ['Aire marine protégée' => 0, 'DPM ou contrôle d\'AOT du DPM' => 1],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'placeholder' => '',
                'label' => "Aire marine spécifique"])
            ->add('typeMission', ChoiceType::class, [
                'choices' => [
                    'Visite de sécurité' => 0,
                    'Contrôle de navire(s)' => 1,
                    'Surveillance d\'aire marine' => 2],
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de mission"])
            ->add('navires', CollectionType::class, [
                'entry_type' => SimpleRapportNavireType::class,
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