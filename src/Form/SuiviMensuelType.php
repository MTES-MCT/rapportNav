<?php

namespace App\Form;

use App\Entity\SuiviMensuel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviMensuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arretTravail', null, [
                'label' => "Arrêts de travail"
            ])
            ->add('congeAnnuel', null, [
                'label' => "Congés annuel"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SuiviMensuel::class,
        ]);
    }
}
