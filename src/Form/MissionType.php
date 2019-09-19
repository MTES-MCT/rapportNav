<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\ZoneGeographique;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $service = $options['service'];
        $builder
            ->add('terrestre', CheckboxType::class, [
                'required' => false,
                'label' => "Activité en/à"])
            ->add('zones', EntityType::class, [
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
                'label' => "Zone de l'activité"])
            ->add('gpsLat')
            ->add('gpsLng')
            ->add('commentaire', TextareaType::class, [
                'label' => "Commentaires et remarques (sur la mission)"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Mission::class,
            'service' => "",
        ]);
    }
}
