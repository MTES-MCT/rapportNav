<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Moyen;
use App\Entity\Rapport;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportBordType extends RapportType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        isset($options['service']) ? $service = $options['service'] : $service = "ulam35";
        parent::buildForm($builder, $options);

        $builder
            ->add('aireMarineSpeciale', ChoiceType::class, [
                'choices' => ['Aire marine protégée' => 0, 'DPM ou contrôle d\'AOT du DPM' => 1],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'placeholder' => '',
                'label' => "Aire marine spécifique"])
            ->add('typeMission', ChoiceType::class, [
                'choices' => [
                    'Visite de sécurité' => 0,
                    'Contrôle de navire(s)' => 1,
                    'Surveillance d\'aire marine' => 2],
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '',
                'label' => "Type de mission"])
            ->add('navires', CollectionType::class, [
                'entry_type' => SimpleRapportNavireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
            'service' => "ulam35",
        ]);
    }
}
