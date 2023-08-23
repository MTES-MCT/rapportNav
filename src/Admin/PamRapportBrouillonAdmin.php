<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use App\Entity\PAM\PamRapport;

final class PamRapportBrouillonAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('number')
            ->add('created_at')
            ->add('created_by')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('number')
            ->add('created_at')
            ->add('updated_at')
            ->add('created_by')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }



    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('number')
            ;
    }

    public function toString($rapport): string {
        return $rapport instanceof PamRapport ? "Rapport n°".$rapport->getId() : 'Rapport';
    }
}
