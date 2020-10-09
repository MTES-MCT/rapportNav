<?php

namespace App\Form;

use App\Entity\CategorieControleNavire;
use App\Entity\CategorieDeroutement;
use App\Entity\CategorieMethodeCiblage;
use App\Entity\ControleNavire;
use App\Entity\Natinf;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleNavireType extends AbstractType {
    /**
     * @var EventSubscriberInterface
     */
    private $restNatinfDataListener;

    public function __construct(EventSubscriberInterface $restNatinfDataListener) {
        $this->restNatinfDataListener = $restNatinfDataListener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('navire', NavireType::class, ['label' => false,])
            ->add('controleNavireRealises', EntityType::class, [
                'class' => CategorieControleNavire::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => "Contrôles réalisés"])
            ->add('pingerApplicable', CheckboxType::class, [
                'required' => false,
                'label' => "La règlementation Pinger est applicable à ce navire"
            ])
            ->add('pingerPresent', CheckboxType::class, [
                'required' => false,
                'label' => "Ce navire possède un pinger"
            ])
            ->add('detailControle', TextType::class, [
                'required' => false,
            ])
            ->add('terrestre', CheckboxType::class, [
                'required' => false,
                'label' => "Activité en/à"])
            ->add('methodeCiblage', EntityType::class, [
                'class' => CategorieMethodeCiblage::class,
                'required' => false,
                'multiple' => false,
                'expanded' => true,
                'placeholder' => false,
                'label' => "Choix du navire par"
            ])
            ->add('date', DateTimeType::class, [
                'required' => true,
                'date_widget' => "single_text",
                'time_widget' => "single_text",
                'input' => "datetime_immutable",
                'label' => "Date du contrôle"
            ])
            ->add('aireProtegee', CheckboxType::class, [
                'required' => false,
                'label' => "Contrôle en aire marine protégée"
            ])
            ->add('chloredeconeTotal', CheckboxType::class, [
                'required' => false,
                'label' => "Zone contamination totale Chlordécone (Antilles)"
            ])
            ->add('chloredeconePartiel', CheckboxType::class, [
                'required' => false,
                'label' => "Zone contamination partielle Chlordécone (Antilles)"
            ])
            ->add('lat', NumberType::class, [
                'label' => "Latitude (degrés positifs/negatifs et minutes décimales)",
                'required' => false
            ])
            ->add('long', NumberType::class, [
                'label' => "Longitude (degrés positifs/negatifs et minutes décimales)",
                'required' => false
            ])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinfs', EntityType::class, [
                'class' => Natinf::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->setMaxResults(1);
                },
                'choice_label' => "numero",
                'choice_value' => "numero",
                'required' => false,
                'multiple' => true,
                'expanded' => false,
                'allow_extra_fields' => true,
                'label' => "Code(s) NATINF",
            ])
            ->add('deroutement', EntityType::class, [
                'class' => CategorieDeroutement::class,
                'choice_label' => "nom",
                'placeholder' => "Sélectionnez la réglementation appliquée",
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'label' => "Action au titre de la lutte contre"
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => "Commentaire (sur ce contrôle)"]);

        $builder->addEventSubscriber($this->restNatinfDataListener);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleNavire::class,
        ]);
    }
}
