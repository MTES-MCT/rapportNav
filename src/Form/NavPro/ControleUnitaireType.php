<?php

namespace App\Form\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
use App\Entity\NavPro\ControleUnitaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleUnitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pvEmis', CheckboxType::class, [
                'label' => 'PV émis ?',
                'label_attr' => ['class' => 'fr-label'],
                'required' => false,
            ])
            ->add('navireEtranger', CheckboxType::class, [
                'required' => false,
                'label' => 'Navire étranger',
                'label_attr' => ['class' => 'fr-label'],
            ])
            ->add('enregistrementNavire', TextType::class, [
                'label' => 'Enregistrement du navire',
                'label_attr' => ['class' => 'fr-label'],
                'attr' => ['class' => 'fr-input fr-input-enregistrement']
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => 'Commentaire et remarque sur ce contrôle',
                'label_attr' => ['class' => 'fr-label'],
                'attr' => ['class' => 'fr-input']
            ])
            ->add('controleRealisesArmement', EntityType::class, [
                'class' => CategorieControleArmement::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (armement)',
                'label_attr' => ['class' => 'fr-label'],
                'choice_attr' => function ($choice, string $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'test'];
                },
            ])
            ->add('controleRealisesGM', EntityType::class, [
                'class' => CategorieControlePersonnel::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contrôles réalisés (gens de mer)',
                'label_attr' => ['class' => 'fr-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControleUnitaire::class,
        ]);
    }
}
