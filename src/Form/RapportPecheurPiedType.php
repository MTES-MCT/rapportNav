<?php

namespace App\Form;

use App\entity\RapportPecheurPied;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportPecheurPiedType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('pecheurPied', PecheurPiedType::class, ['label' => false,])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinf', TextType::class, [
                'required' => false,
                'label' => "Code(s) NATINF "])
            ->add('commentaire', TextType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportPecheurPied::class,
        ]);
    }
}
