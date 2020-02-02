<?php

namespace App\Form;

use App\Entity\ControlePecheurPiedSansPv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlePecheurPiedSansPvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreControle', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de pêcheurs contrôlés sans PV"
            ])
            ->add('nombreControleAireProtegee', IntegerType::class, [
                'required' => false,
                'label' => "dont en aire marine protégée"
            ])
            ->add('nombreControleChlordeconeTotale', IntegerType::class, [
                'required' => false,
                'label' => "dont en zone chlordécone totale (Antilles)"
            ])
            ->add('nombreControleChlordeconePartiel', IntegerType::class, [
                'required' => false,
                'label' => "dont en zone chlordécone partielle (Antilles)"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ControlePecheurPiedSansPv::class,
        ]);
    }
}
