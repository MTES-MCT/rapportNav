<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Rapport;
use App\Entity\ZoneGeographique;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $service = $options['service'];

        $builder
            ->add('dateDebutMission', DateTimeType::class, ['required' => true, 'label' => "Démarrage de la mission"])
            ->add('dateFinMission', DateTimeType::class, ['required' => true, 'label' => "Fin de mission"])
            ->add('terrestre', CheckboxType::class, [
                'required' => false,
                'label' => "Mission à terre (en mer si non cochée)"])
            ->add('zoneMissions', EntityType::class, [
                'class' => ZoneGeographique::class,
                'query_builder' => function(EntityRepository $er) use ($service) {
                    return $er->createQueryBuilder('z')
                        ->where('z.direction = :service OR z.alias = :alias OR z.direction = \'tous\' ')
                        ->setParameters([
                            'service' => "DDTM".mb_strcut($service, 4),
                            'alias' => mb_strcut($service, 4)]);
                },
                'choice_label' => "nom",
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => "Zone de la mission"])
            ->add('arme', CheckboxType::class, [
                'required' => false,
                'label' => "Mission armée ?"])
            ->add("moyens", CollectionType::class, [
                'entry_type' => RapportMoyenType::class,
                'entry_options' => ['service' => $service],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
            ])
            ->add('agents', EntityType::class, [
                'class' => Agent::class,
                'query_builder' => function(EntityRepository $er) use ($service) {
                    return $er->createQueryBuilder('a')
                        ->where('a.service = :service')
                        ->setParameter("service", $service);
                },
                'multiple' => true,
                'expanded' => true,
                'label' => "Agents embauchés sur la mission"])
            ->add('commentaire', null, [
                'label' => "Commentaires et remarques (pour note interne)"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "",
        ]);
    }
}
