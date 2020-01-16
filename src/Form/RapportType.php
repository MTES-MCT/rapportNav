<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Rapport;
use App\Entity\ServiceInterministeriel;
use App\Form\EventListener\ServiceInterministerielListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType {

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var EventSubscriberInterface
     */
    private $addServiceInterministerielListener;

    public function __construct(EntityManagerInterface $em, ServiceInterministerielListener $addServiceInterministerielListener) {
        $this->em = $em;
        $this->addServiceInterministerielListener = $addServiceInterministerielListener;
    }

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
                'label' => "Mission armée"])
            ->add("moyens", CollectionType::class, [
                'entry_type' => RapportMoyenType::class,
                'entry_options' => ['service' => $service],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'required' => false,
            ])
            ->add('conjointe', CheckboxType::class, [
                'required' => false,
                'label' => ""
            ])
            ->add('serviceConjoints', EntityType::class, [
                'required' => false,
                'class' => ServiceInterministeriel::class,
                'multiple' => true,
                'expanded' => false,
                'allow_extra_fields' => true,
                'label' => "Service(s) conjoint(s)",
                'choice_label' => "nom"
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

        $builder->addEventSubscriber($this->addServiceInterministerielListener);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "",
        ]);
    }
}
