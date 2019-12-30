<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Rapport;
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
            ->add('dateDebutMission', DateTimeType::class, [
                'required' => true,
                'date_widget' => "single_text",
                'time_label' => "Heure de démarrage",
                'time_widget' => "single_text",
                'label' => "Date de la mission"])
            ->add('dateFinMission', DateTimeType::class, [
                'required' => true,
                'date_widget' => "single_text",
                'time_label' => "Heure de fin",
                'time_widget' => "single_text",
                'label' => "Fin de mission"])
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
                'required' => false,
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
                'label' => "Agents de la mission"])
            ->add('missions', CollectionType::class, [
                'entry_type' => MissionType::class,
                'entry_options' => ['service' => $service],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
            ])
            ->add('repartitionHeures', RapportRepartitionHeuresType::class)
            ->add('commentaire', null, [
                'label' => "Commentaires et remarques (globales pour ce rapport)"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "",
        ]);
    }
}
