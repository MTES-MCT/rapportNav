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
        
        if($builder->getData() &&  Rapport::class === get_class($builder->getData()) ) {
            $dateCheckAgentsPresents = $builder->getData()->getDateDebutMission() ? $builder->getData()->getDateDebutMission()->format("Y-m-d") : date("Y-m-d");
        } else {
            $dateCheckAgentsPresents = date("Y-m-d");
        }

        $builder
            ->add('dateDebutMission', DateTimeType::class, [
                'required' => true,
                'date_widget' => "single_text",
                'time_label' => "Heure de démarrage (heure locale)",
                'time_widget' => "single_text",
                'label' => "Date de la mission"])
            ->add('dateFinMission', DateTimeType::class, [
                'required' => true,
                'date_widget' => "single_text",
                'time_label' => "Heure de fin  (heure locale)",
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
                'label' => "Activite conjointe (avec un autre service)"
            ])
            ->add('serviceConjoints', EntityType::class, [
                'required' => false,
                'class' => ServiceInterministeriel::class,
                'multiple' => true,
                'expanded' => false,
                'allow_extra_fields' => true,
                'label' => "Service(s) associé(s) dans la mission conjointe(s)",
                'choice_label' => "nom",
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy("s.nom", "ASC");
                }
            ])
            ->add('agents', EntityType::class, [
                'class' => Agent::class,
                'query_builder' => function(EntityRepository $er) use ($service, $dateCheckAgentsPresents) {
                    return $er->createQueryBuilder('a')
                        ->where('a.service = :service')
                        ->andWhere('a.dateArrivee <= :date')
                        ->andWhere('a.dateDepart IS NULL OR a.dateDepart > :date')
                        ->setParameters(["service" => $service, "date" => $dateCheckAgentsPresents]);
                },
                'multiple' => true,
                'expanded' => true,
                'label' => "Agents de la mission"])
            ->add('activites', CollectionType::class, [
                'entry_type' => ActiviteType::class,
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
