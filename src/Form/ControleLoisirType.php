<?php

namespace App\Form;

use App\Entity\ControleLoisir;
use App\Entity\Loisir;
use App\Entity\Natinf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleLoisirType extends AbstractType {
  /**
   * @var EventSubscriberInterface
   */
  private $restNatinfDataListener;

  public function __construct(EventSubscriberInterface $restNatinfDataListener) {
    $this->restNatinfDataListener = $restNatinfDataListener;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
        ->add('loisir', EntityType::class, [
            'class' => Loisir::class,
            'choice_label' =>  "nom",
            'multiple' => false,
            'expanded' => false,
            'placeholder' => "Sélectionnez le type de contrôle",
        ])
        ->add('nombreControle', IntegerType::class, [
            'required' => true,
            'label' => "Nombre de contrôles réalisés"])
        ->add('nombrePv', IntegerType::class, [
            'required' => false,
            'label' => "Nombre de PV émis"])
        ->add('natinfs', EntityType::class, [
            'class' => Natinf::class,
            'choice_label' => "numero",
            'choice_value' => "numero",
            'multiple' => true,
            'expanded' => false,
            'required' => false,
            'label' => "Code(s) NATINF "])
        ->add('commentaire', TextareaType::class, ['required' => false]);

    $builder->addEventSubscriber($this->restNatinfDataListener);

  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
        'data_class' => ControleLoisir::class,
    ]);
  }

}
