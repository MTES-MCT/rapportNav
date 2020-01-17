<?php


namespace App\Form\EventListener;


use App\Entity\ServiceInterministeriel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ServiceInterministerielListener implements EventSubscriberInterface {
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents() {
        return [
            FormEvents::PRE_SUBMIT => "onPreSubmit"
        ];
    }

    /**
     * Creates and flush the missing entities if any is found.
     * Then re-creates the form element to refresh the choice list
     *
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event) {
        $formData = $event->getData();
        /** @var array|null $data */
        $data = array_key_exists("serviceConjoints", $formData) ? $formData['serviceConjoints'] : [];

        $newData = [];
        $newDataObj = [];

        foreach($data as $key => $servConj) {
            if(!is_numeric($servConj)) {
                $newData[] = $servConj;
                unset($data[$key]);
            }
        }

        foreach($newData as $serConjName) {
            $newDataObj[] = new ServiceInterministeriel();
            $lastKey = array_key_last($newDataObj);
            $newDataObj[$lastKey]->setNom($serConjName);
            $this->em->persist($newDataObj[$lastKey]);
        }
        $this->em->flush();
        $formData['serviceConjoints'] = array_merge($data, array_map(function(ServiceInterministeriel $val) { return $val->getId(); }, $newDataObj));
        $event->setData($formData);

        $event->getForm()->add('serviceConjoints', EntityType::class, [
            'required' => false,
            'class' => ServiceInterministeriel::class,
            'choice_label' => "nom",
            'multiple' => true,
            'expanded' => false,
            'allow_extra_fields' => true,
            'label' => "Service(s) associé(s) dans la mission conjointe(s)",
        ]);
    }
}