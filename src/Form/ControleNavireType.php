<?php

namespace App\Form;

use App\Entity\MethodeCiblage;
use App\Entity\Natinf;
use App\Entity\ControleNavire;
use App\Entity\RapportNavireControle;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('controles', EntityType::class, [
                'class' => RapportNavireControle::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => "Contrôles réalisés"])
            ->add('methodeCiblage', EntityType::class, [
                'class' => MethodeCiblage::class,
                'required' => false,
                'multiple' => false,
                'expanded' => true,
                'placeholder' => false,
                'label' => "Choix du navire par"
            ])
            ->add('aireProtegee', CheckboxType::class, [
                'required' => false,
                'label' => "Contrôle en aire marine protégée"
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
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => "Notes et commentaires"]);

        $builder->addEventSubscriber($this->restNatinfDataListener);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleNavire::class,
        ]);
    }
}
