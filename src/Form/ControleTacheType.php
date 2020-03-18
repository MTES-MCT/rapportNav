<?php

namespace App\Form;

use App\Entity\ControleTache;
use App\Entity\Tache;
use App\Form\DataTransformer\TimeToIntegerTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleTacheType extends AbstractType {
    /** @var TimeToIntegerTransformer */
    private $transformer;

    public function __construct(TimeToIntegerTransformer $transformer) {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('tache', EntityType::class, [
                'class' => Tache::class,
                'choice_label' => "nom",
                'label' => "Tâche",
                'multiple' => false,
                'expanded' => false,
                'placeholder' => "Sélectionnez l'activité réalisée",
                'choice_attr' => function($choice, $key, $value) {
                    /** @var Tache $choice */
                    if(null === $choice->getComplementDonnee()) {
                        return [];
                    }
                    return ['data-complement' => $choice->getComplementDonnee()];
                },
            ])
            ->add('detailTache', TextType::class, [
                'required' => false,
                'label' => "Détail de la tâche (optionnel)"
            ])
            ->add('nombreDossiers', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de dossiers traités",
            ])
            ->add('dureeTache', TimeType::class, [
                'widget' => "single_text",
                'required' => true,
                'invalid_message' => 'Durée invalide',
                'label' => "Durée de l'activité"])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => "Commentaire (sur ce contrôle)"
            ])
        ;

        $builder->get('dureeTache')
            ->addModelTransformer($this->transformer);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleTache::class,
        ]);
    }

}
