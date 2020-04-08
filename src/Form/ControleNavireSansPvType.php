<?php

namespace App\Form;

use App\Entity\CategorieControleNavire;
use App\Entity\ControleNavireSansPv;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleNavireSansPvType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombreControle', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de navires non professionnels contrôlés sans PV"
            ])
            ->add('nombreControleAireProtegee', IntegerType::class, [
                'required' => false,
                'label' => "dont en aire marine protégée"
            ])
            ->add('controleNavireRealises', EntityType::class, [
                'class' => CategorieControleNavire::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => "Contrôles réalisés sur chacun de ces navires"]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleNavireSansPv::class,
        ]);
    }
}
