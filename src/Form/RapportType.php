<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Moyen;
use App\Entity\Rapport;
use App\Entity\ZoneGeographique;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $service = $options['service'];

        $builder
            ->add('dateDebutMission', DateTimeType::class, ['required' => true, 'label' => "Démarrage de la mission"])
            ->add('dateFinMission', DateTimeType::class, ['required' => true, 'label' => "Fin de mission"])
            ->add('distanceTerrestre', IntegerType::class, [
                'required' => false,
                'label' => "Kilomètres parcourus par véhicule terrestre (si pertinent)"])
            ->add('lieuMission', ChoiceType::class, [
                'choices' => ['Mer' => 0, 'Terre' => 1],
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Lieu de la mission"])
            ->add('zoneMissions', EntityType::class, [
                'class' => ZoneGeographique::class,
                'query_builder' => function(EntityRepository $er) use ($service) {
                    return $er->createQueryBuilder('z')
                        ->where('z.direction = :service OR z.alias = :alias OR z.direction = \'tous\' ')
                        ->setParameters([
                            'service' => "DDTM" . mb_strcut($service, 4),
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
            ->add('moyens', EntityType::class, [
                'class' => Moyen::class,
                'choice_label' => 'nom',
                'query_builder' => function(EntityRepository $er) use ($service) {
                    return $er->createQueryBuilder('m')
                        ->where('m.possesseur = :service')
                        ->setParameter("service", $service);
                },
                'multiple' => true,
                'expanded' => true,
                'label' => "Moyens utilisés"])
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
                'label' => "Commentaires et remarques (pour note interne)"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "",
        ]);
    }
}
