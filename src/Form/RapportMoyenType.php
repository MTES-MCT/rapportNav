<?php


namespace App\Form;


use App\Entity\Moyen;
use App\Entity\RapportMoyen;
use App\Form\DataTransformer\TimeToIntegerTransformer;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportMoyenType extends AbstractType {

    /** @var TimeToIntegerTransformer */
    private $transformer;

    public function __construct(TimeToIntegerTransformer $transformer) {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options) {
        $service = $options['service'];

        $builder->add("moyen", EntityType::class, [
            'class' => Moyen::class,
            'query_builder' => function(EntityRepository $er) use ($service) {
                return $er->createQueryBuilder("m")
                    ->where("m.serviceProprietaire = :service")
                    ->setParameter("service", $service);
            },
            'multiple' => false,
            'expanded' => false,
            'placeholder' => "Sélectionnez un moyen utilisé",
            'choice_attr' => function($choice, $key, $val) {
                /** @var Moyen $choice */
                return ['data-type' => (int)($choice->getTerrestre())];
            }
        ])
            ->add("distance", IntegerType::class, [
                'required' => false,
                'label' => "Distance (km)",
                'invalid_message' => 'Distance invalide',
            ])
            ->add("tempsMoteur", TimeType::class, [
                'required' => false,
                'widget' => "single_text",
                'invalid_message' => 'Durée invalide',
                'label' => "Temps moteur",
            ]);
        $builder->get('tempsMoteur')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportMoyen::class,
            'service' => "",
        ]);
    }
}