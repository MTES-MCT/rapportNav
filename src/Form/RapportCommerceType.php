<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Moyen;
use App\Entity\Rapport;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportCommerceType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        isset($options['service']) ? $service = $options['service'] : $service = "ulam35";

        $builder
            ->add('dateMission', DateType::class, ['required' => true, 'label' => "Date de la mission"])
            ->add('typeRapport', ChoiceType::class, [
                'choices' => ['Ciblé' => 0, 'Ciblé manuellement' => 1, 'Aléatoire' => 2, 'Opportunité' => 3],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de contrôle"])
            ->add('agents', EntityType::class, [
                'class' => Agent::class,
                'query_builder' => function (EntityRepository $er) use ( $service ) {
                    return $er->createQueryBuilder('a')
                        ->where('a.service = :service')
                        ->setParameter("service", $service)
                        ;
                },
                'multiple' => true,
                'expanded' => true,
                'label' => "Agents embauchés sur la mission"])
            ->add('lieuMission', ChoiceType::class, [
                'choices' => ['Mer' => 0, 'Terre' => 1],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Lieu de la mission"])
            ->add('zoneMission', ChoiceType::class, [
                'choices' => ['Ouest 56' => 0,
                    'Est 56' => 1,
                    'Rade LO' => 2,
                    'Groix et courreaux' => 3,
                    'Riv Etel' => 4,
                    'Ouest Quiberon' => 5,
                    'Belle-Ile et courreaux' => 6,
                    'Houat' => 7,
                    'Hoëdic' => 8,
                    'Baie Quiberon' => 9,
                    'Golfe' => 10,
                    'Riv Auray' => 11,
                    'Littoral Est' => 12,
                    'Vilaine' => 13,
                ],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'required' => false,
                'label' => "Zone de la mission (ULAM56)"])
            ->add('arme', CheckboxType::class, [
                'required' => false,
                'label' => "Mission armée ?"])
            ->add('dureeMission', IntegerType::class, [
                'required' => true,
                'label' => "Durée de la mission (en minutes)"])
            ->add('moyens', EntityType::class, [
                'class' => Moyen::class,
                'choice_label' => 'nom',
                'query_builder' => function (EntityRepository $er) use ( $service ) {
                    return $er->createQueryBuilder('m')
                        ->where('m.possesseur = :service')
                        ->setParameter("service", $service)
                        ;
                },
                'multiple' => true,
                'expanded' => true,
                'label' => "Moyens utilisés"])
            ->add('distanceTerrestre', IntegerType::class, [
                'required' => false,
                'label' => "Distance parcourue par véhicule (si pertinent)"])
            ->add('etablissements', CollectionType::class, [
                'entry_type' => SimpleRapportEtablissementType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('commentaire', null, [
                'label' => "Commentaires et remarques (pour note interne)"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "ulam35",
        ]);
    }
}
