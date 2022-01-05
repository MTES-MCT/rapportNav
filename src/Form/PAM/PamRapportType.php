<?php

namespace App\Form\PAM;

use App\Entity\PAM\PamRapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PamRapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('nb_jours_mer')
            ->add('nav_eff')
            ->add('mouillage')
            ->add('maintenance')
            ->add('meteo')
            ->add('representation')
            ->add('administratif')
            ->add('autre')
            ->add('contr_port')
            ->add('technique')
            ->add('distance')
            ->add('go_marine')
            ->add('essence')
            ->add('start_datetime')
            ->add('end_datetime')
            ->add('personnel')
            ->add('equipage')
            ->add('created_by')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PamRapport::class,
        ]);
    }
}
