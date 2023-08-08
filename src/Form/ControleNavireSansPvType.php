<?php

namespace App\Form;

use App\Entity\CategorieControleNavire;
use App\Entity\ControleNavireSansPv;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleNavireSansPvType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombreControleMer', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de navires non professionnels contrôlés sans PV en mer"
            ])
            ->add('nombreControleTerre', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de navires non professionnels contrôlés sans PV à quai/terre"
            ])
            ->add('nombreControleAireProtegee', IntegerType::class, [
                'required' => false,
                'label' => "dont contrôles en aire marine protégée (terre et mer)"
            ])
            ->add('controleNavireRealises', EntityType::class, [
                'class' => CategorieControleNavire::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => "Contrôles réalisés sur chacun de ces navires",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ccn')
                        ->where('ccn.active = true');
                }
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ControleNavireSansPv::class,
        ]);
    }
}
