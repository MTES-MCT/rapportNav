<?php


namespace App\Form;


use App\Entity\Moyen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoyenType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("nom", TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Moyen::class,
            'service' => "",
        ]);
    }

}