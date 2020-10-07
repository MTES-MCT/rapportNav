<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Natinf;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class NatinfAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof Natinf
            ? $object->getNumero() . " (". $object->getLibelle() .")"
            : 'Natinf'; 
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('numero')
            ->add('description')
            ->add('codeNatAff')
            ->add('libelle')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->addIdentifier('numero')
            ->add('description')
            ->add('codeNatAff', null, ['label' => "Code NatAff"])
            ->add('libelle', null, ['label' => "Libellé Nature d'affaire"])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('numero', NumberType::class)
            ->add('description', TextType::class)
            ->add('codeNatAff', TextType::class, ['label' => "Code NatAff"])
            ->add('libelle', TextType::class, ['label' => "Libellé NatAff"])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('numero')
            ->add('description')
            ->add('codeNatAff')
            ->add('libelle')
            ;
    }
}
