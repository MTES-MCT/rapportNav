<?php

namespace App\Form;

use App\Entity\PecheurPied;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PecheurPiedType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom"])
            ->add('prenom', TextType::class, ['required' => false, 'label' => "Prénom"])
            ->add('estPro', CheckboxType::class, [
                'required' => false,
                'label' => "Professionnel"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => PecheurPied::class,
        ]);
    }
}
