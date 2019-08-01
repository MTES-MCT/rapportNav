<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Marché plaisance : concessionnaire' => 0,
                    'Culture marine' => 1,
                    'Site de débarquement' => 2,
                    'Criée' => 3,
                    'Commerce à terre' => 4,
                    'Mareyeur' => 5,
                    'contrôle routier' => 6,
                    'Formation à la conduite mer et eaux intérieures' => 7,
                    'autre' => 8],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de d'établissement"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
