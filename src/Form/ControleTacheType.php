<?php

namespace App\Form;

use App\Entity\ControleTache;
use App\Entity\Tache;
use App\Form\DataTransformer\TimeToIntegerTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                'multiple' => false,
                'expanded' => false,
                'placeholder' => "Sélectionnez l'activité réalisée",
            ])
            ->add('dureeTache', TimeType::class, [
                'widget' => "single_text",
                'required' => true,
                'invalid_message' => 'Durée invalide',
                'label' => "Durée de l'activité"])
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
