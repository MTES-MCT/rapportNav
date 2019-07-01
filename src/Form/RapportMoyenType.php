<?php


namespace App\Form;


use App\Entity\Moyen;
use App\Entity\RapportMoyen;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportMoyenType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $service = $options['service'];

        $builder->add("moyen", EntityType::class, [
            'class' => Moyen::class,
            'query_builder' => function(EntityRepository $er) use ($service) {
                return $er->createQueryBuilder("m")
                    ->where("m.possesseur = :service")
                    ->setParameter("service", $service);
            },
            'multiple' => false,
            'expanded' => false,
            'placeholder' => "Sélectionnez un moyen utilisé",
            'label' => false,
            'choice_attr' => function($choice, $key, $val) {
                /** @var Moyen $choice */
                return ['data-type' => $choice->getType()];
            }
        ])
            ->add("distance", IntegerType::class)
            ->add("tempsMoteur", IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportMoyen::class,
            'service' => "",
        ]);
    }
}