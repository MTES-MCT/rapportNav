<?php

namespace App\Form;

use App\Entity\ActiviteCommerce;
use App\Entity\Rapport;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteCommerceType extends ActiviteType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
            ->add('etablissements', CollectionType::class, [
                'entry_type' => ControleEtablissementType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ActiviteCommerce::class,
            'service' => "",
        ]);
    }
}
