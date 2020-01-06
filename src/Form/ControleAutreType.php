<?php

namespace App\Form;

use App\Entity\CategorieControleAutre;
use App\Entity\ControleAutre;
use App\Entity\Natinf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleAutreType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('controle', EntityType::class, [
                'class' => CategorieControleAutre::class,
                'choice_label' => "nom",
                'multiple' => false,
                'expanded' => false,
                'label' => "Contrôle",
                'placeholder' => "Sélectionnez le type de contrôle",
            ])
            ->add('nombreControle', IntegerType::class, [
                'required' => true,
                'label' => "Nombre de contrôles total réalisés"])
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
            ->add('commentaire', TextareaType::class, [
                'required' => false,
                'label' => "Commentaire (sur ce contrôle)"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleAutre::class,
        ]);
    }
}
