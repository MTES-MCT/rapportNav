<?php

namespace App\Form;

use App\Entity\Natinf;
use App\Entity\RapportNavire;
use App\Entity\RapportNavireControle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportNavireType extends AbstractType {
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('navire', NavireType::class, ['label' => false,])
            ->add('controles', EntityType::class, [
                'class' => RapportNavireControle::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => "Contrôles réalisés"])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinfs', EntityType::class, [
                'class' => Natinf::class,
                'choice_label' => "numero",
                'choice_value' => "numero",
                'required' => false,
                'multiple' => true,
                'expanded' => false,
                'label' => "Code(s) NATINF"])
            ->add('commentaire', TextType::class, [
                'required' => false,
                'label' => "Notes et commentaires"]);

        //Dynamic addition of Natinf
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function(FormEvent $event) {
                /** @var ?Navire $data */
                $data = $event->getData();
                $natinfs = $data['natinfs'] ? $data['natinfs'] : [];
                foreach($natinfs as $codeNatinf) {
                    $natinf = new Natinf();
                    $natinf->setNumero($codeNatinf);
                    $this->em->persist($natinf);
                }
                $this->em->flush();
            }
        );

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportNavire::class,
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
