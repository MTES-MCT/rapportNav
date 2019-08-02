<?php

namespace App\Form;

use App\Entity\Natinf;
use App\Entity\RapportEtablissement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportEtablissementType extends AbstractType {
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('etablissement', EtablissementType::class, ['label' => false,])
            ->add('pv', CheckboxType::class, [
                'required' => false,
                'label' => "PV émis ?"])
            ->add('natinfs', EntityType::class, [
                'class' => Natinf::class,
                'choice_label' => "numero",
                'choice_value' => "numero",
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'label' => "Code(s) NATINF "])
            ->add('bateauxControles', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre de navires contrôlés'])
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
            'data_class' => RapportEtablissement::class,
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
