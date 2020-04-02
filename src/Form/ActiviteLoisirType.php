<?php

namespace App\Form;

use App\Entity\ActiviteLoisir;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteLoisirType extends ActiviteType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    parent::buildForm($builder, $options);

    $builder
        ->add('loisirs', CollectionType::class, [
            'entry_type' => ControleLoisirType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'label' => false,
        ]);
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
        'data_class' => ActiviteLoisir::class,
        'service' => "",
    ]);
  }
}
