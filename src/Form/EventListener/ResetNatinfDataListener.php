<?php


namespace App\Form\EventListener;


use App\Entity\Natinf;
use App\Service\NatinfFiller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ResetNatinfDataListener implements EventSubscriberInterface {
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

    public static function getSubscribedEvents() {
       return [
           FormEvents::PRE_SET_DATA => "onPreSetData",
           FormEvents::PRE_SUBMIT => "onPreSubmit"
       ]
           ;
    }

    public function onPreSetData(FormEvent $event) {
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

    public function onPreSubmit(FormEvent $event) {
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
}