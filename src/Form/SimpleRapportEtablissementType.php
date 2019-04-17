<?php

namespace App\Form;

use App\Entity\RapportEtablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleRapportEtablissementType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('etablissement', SimpleEtablissementType::class, ['label' => false,])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinf', TextType::class, [
                'required' => false,
                'label' => "Code(s) NATINF "])
            ->add('bateauxControles', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre de navires contrôlés'])
            ->add('commentaire', TextType::class, [
                'required' => false,
                'label' => "Notes et commentaires"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportEtablissement::class,
        ]);
    }
}
