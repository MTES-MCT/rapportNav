<?php

namespace App\Form;

use App\Entity\Natinf;
use App\entity\RapportPecheurPied;
use App\Service\NatinfFiller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportPecheurPiedType extends AbstractType {
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
            ->add('pecheurPied', PecheurPiedType::class, ['label' => false,])
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
            ->add('commentaire', TextType::class, ['required' => false]);

        //Dynamic addition of Natinf
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) {
                $data = ($event->getData()) ? $event->getData()->getNatinfs() : null;
                $event->getForm()->add('natinfs', EntityType::class, [
                    'class' => Natinf::class,
                    'query_builder' => function(EntityRepository $er) use ($data) {
                        return $er->createQueryBuilder('n')
                            ->where("n.id IN (:natinfs)")
                            ->setParameter('natinfs', $data);
                    },
                    'choice_label' => "numero",
                    'choice_value' => "numero",
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'allow_extra_fields' => true,
                    'label' => "Code(s) NATINF",
                    ]);
            }
        );

        //Dynamic addition of Natinf
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function(FormEvent $event) {
                /** @var ?Navire $data */
                $data = array_key_exists("natinfs", $event->getData()) ? $event->getData()['natinfs'] : null;
                $natinfs = $data ?: [];
                $this->dbRecorder->fromArray($natinfs);
                $event->getForm()->add('natinfs', EntityType::class, [
                    'class' => Natinf::class,
                    'query_builder' => function(EntityRepository $er) use ($data) {
                        return $er->createQueryBuilder('n')
                            ->where("n.numero IN (:natinfs)")
                            ->setParameter('natinfs', $data);
                    },
                    'choice_label' => "numero",
                    'choice_value' => "numero",
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                    'allow_extra_fields' => true,
                    'label' => "Code(s) NATINF",
                    ]);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => RapportPecheurPied::class,
        ]);
    }

}
