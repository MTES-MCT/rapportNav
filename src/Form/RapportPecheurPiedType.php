<?php

namespace App\Form;

use App\entity\RapportPecheurPied;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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

        //Dynamic addition of Natinf
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) {
                /** @var ?Navire $data */
                $data = $event->getData();
                $natinf = $data ? $data->getNatinf() : [];
                $form = $event->getForm();
                $toDisplay = $this->transformNatinfArray($natinf);
                $form->add('natinf', ChoiceType::class, [
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'choices' => $toDisplay,
                    'label' => "Code(s) NATINF"]);
            }
        );

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function(FormEvent $event) {
                $natinf = $event->getData()['natinf'];
                $form = $event->getForm();
                $form->add('natinf', ChoiceType::class, [
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'choices' => $natinf,
                    'label' => "Code(s) NATINF"]);
            });
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportPecheurPied::class,
        ]);
    }

    private function transformNatinfArray(?array $natinfs): ?array {
        $result = [];
        if(!$natinfs) {
            return $result;
        }

        foreach($natinfs as $natinf) {
            $result[] = [$natinf => $natinf];
        }

        return $result;
    }
}
