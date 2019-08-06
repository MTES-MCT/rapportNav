<?php

namespace App\Form;

use App\Entity\Natinf;
use App\Entity\RapportNavire;
use App\Entity\RapportNavireControle;
use App\Service\NatinfFiller;
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
    /**
     * @var NatinfFiller
     */
    private $dbRecorder;

    public function __construct(EntityManagerInterface $em, NatinfFiller $dbRecorder) {
        $this->em = $em;
        $this->dbRecorder = $dbRecorder;
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
                'allow_extra_fields' => true,
                'label' => "Code(s) NATINF"])
            ->add('commentaire', TextType::class, [
                'required' => false,
                'label' => "Notes et commentaires"]);

        //Dynamic addition of Natinf
        $builder->get('natinfs')->addEventListener(
            FormEvents::PRE_SUBMIT,
            function(FormEvent $event) {
                /** @var ?Navire $data */
                $data = $event->getData();
                $natinfs = $data ?: [];
                $this->dbRecorder->fromArray($natinfs);
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
