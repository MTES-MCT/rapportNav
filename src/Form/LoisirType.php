<?php

namespace App\Form;

use App\Entity\Loisir;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoisirType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add("nom", TextType::class);
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
        'data_class' => Loisir::class,
        'service' => "",
    ]);
  }

}