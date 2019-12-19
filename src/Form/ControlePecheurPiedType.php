<?php

namespace App\Form;

use App\Entity\Natinf;
use App\Entity\ControlePecheurPied;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlePecheurPiedType extends AbstractType {
    /**
     * @var EventSubscriberInterface
     */
    private $restNatinfDataListener;

    public function __construct(EventSubscriberInterface $restNatinfDataListener) {
        $this->restNatinfDataListener = $restNatinfDataListener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('pecheurPied', PecheurPiedType::class, ['label' => false,])
            ->add('date', DateTimeType::class, [
                'required' => true,
                'widget' => "single_text",
//                'time_widget' => "single_text",
                'input' => "datetime_immutable",
                'label' => "Date du contrôle"
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
                'choice_label' => "numero",
                'choice_value' => "numero",
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'label' => "Code(s) NATINF "])
            ->add('commentaire', TextType::class, ['required' => false]);

        $builder->addEventSubscriber($this->restNatinfDataListener);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControlePecheurPied::class,
        ]);
    }

}
