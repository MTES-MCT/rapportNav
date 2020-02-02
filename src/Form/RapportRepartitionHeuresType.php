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
            ->add('controleAerien', TimeType::class, [
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
            ->add('controleAireProtegeeAerien', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controlePollutionMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controlePollutionTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controlePollutionAerien', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleEnvironnementMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleEnvironnementTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleEnvironnementAerien', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleChlordeconePartielMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleChlordeconePartielTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleChlordeconeTotalMer', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleChlordeconeTotalTerre', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('controleCroise', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('immigration', TimeType::class, [
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
            ->add('assistance', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
            ->add('plongee', TimeType::class, [
                'widget' => "single_text",
                'required' => false,
            ])
        ;
        $builder->get('controleMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAerien')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAireProtegeeMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAireProtegeeTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleAireProtegeeAerien')
            ->addModelTransformer($this->transformer);
        $builder->get('controlePollutionMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controlePollutionTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controlePollutionAerien')
            ->addModelTransformer($this->transformer);
        $builder->get('controleEnvironnementMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleEnvironnementTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleEnvironnementAerien')
            ->addModelTransformer($this->transformer);
        $builder->get('controleChlordeconeTotalMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleChlordeconeTotalTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleChlordeconePartielMer')
            ->addModelTransformer($this->transformer);
        $builder->get('controleChlordeconePartielTerre')
            ->addModelTransformer($this->transformer);
        $builder->get('controleCroise')
            ->addModelTransformer($this->transformer);
        $builder->get('immigration')
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
        $builder->get('assistance')
            ->addModelTransformer($this->transformer);
        $builder->get('plongee')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportRepartitionHeures::class,
        ]);
    }
}
