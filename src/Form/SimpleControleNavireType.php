<?php

namespace App\Form;

use App\Entity\ControleNavire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleControleNavireType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('navire', SimpleNavireType::class, ['label' => false,])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinf', TextType::class, [
                'required' => false,
                'label' => "Code(s) NATINF "])
            ->add('commentaire', TextType::class, [
                'required' => false,
                'label' => "Notes et commentaires"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleNavire::class,
        ]);
    }
}
