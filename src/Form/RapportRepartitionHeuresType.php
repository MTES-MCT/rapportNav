<?php

namespace App\Form;

use App\Entity\RapportRepartitionHeures;
use App\Form\DataTransformer\TimeToIntegerTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportRepartitionHeuresType extends AbstractType {
    /** @var TimeToIntegerTransformer */
    private $transformer;

    public function __construct(TimeToIntegerTransformer $transformer) {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('controleMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleAireProtegeeMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleAireProtegeeTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('visiteSecurite', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('nombreVisiteSecurite', IntegerType::class, [
                'required' => false,
            ])
            ->add('surveillanceManifestationMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('surveillanceManifestationTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('surveillanceDpmMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('surveillanceDpmTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('surete', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('maintienOrdre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('nombreOperationMaintienOrdre', IntegerType::class, [
                'required' => false,
            ])
        ;
        $builder->get('controleMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAireProtegeeMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAireProtegeeTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('visiteSecurite')
            ->addModelTransformer($this->transformer);
        $builder->get('surveillanceManifestationMer')
            ->addModelTransformer($this->transformer);
        $builder->get('surveillanceManifestationTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('surveillanceDpmMer')
            ->addModelTransformer($this->transformer);
        $builder->get('surveillanceDpmTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('surete')
            ->addModelTransformer($this->transformer);
        $builder->get('maintienOrdre')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportRepartitionHeures::class,
        ]);
    }
}
