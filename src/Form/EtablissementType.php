<?php

namespace App\Form;

use App\Entity\CategorieEtablissement;
use App\Entity\Etablissement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class, ['required' => true, 'label' => "Nom (ou N/A pour non applicable)"])
            ->add('adresse', TextType::class, ['required' => false])
            ->add('commune', TextType::class, ['required' => false])
            ->add('type', EntityType::class, [
                'class' => CategorieEtablissement::class,
                'choice_label' => "nom",
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Sélectionnez la catégorie d\'établissement',
                'label' => "Type de d'établissement"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
