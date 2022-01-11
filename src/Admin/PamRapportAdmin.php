<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class PamRapportAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('nb_jours_mer')
            ->add('nav_eff')
            ->add('mouillage')
            ->add('maintenance')
            ->add('meteo')
            ->add('representation')
            ->add('administratif')
            ->add('autre')
            ->add('contr_port')
            ->add('technique')
            ->add('distance')
            ->add('go_marine')
            ->add('essence')
            ->add('start_datetime')
            ->add('end_datetime')
            ->add('personnel')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('nb_jours_mer')
            ->add('nav_eff')
            ->add('mouillage')
            ->add('maintenance')
            ->add('meteo')
            ->add('representation')
            ->add('administratif')
            ->add('autre')
            ->add('contr_port')
            ->add('technique')
            ->add('distance')
            ->add('go_marine')
            ->add('essence')
            ->add('start_datetime')
            ->add('end_datetime')
            ->add('personnel')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('created_at')
            ->add('updated_at')
            ->add('nb_jours_mer')
            ->add('nav_eff')
            ->add('mouillage')
            ->add('maintenance')
            ->add('meteo')
            ->add('representation')
            ->add('administratif')
            ->add('autre')
            ->add('contr_port')
            ->add('technique')
            ->add('distance')
            ->add('go_marine')
            ->add('essence')
            ->add('start_datetime')
            ->add('end_datetime')
            ->add('personnel')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('nb_jours_mer')
            ->add('nav_eff')
            ->add('mouillage')
            ->add('maintenance')
            ->add('meteo')
            ->add('representation')
            ->add('administratif')
            ->add('autre')
            ->add('contr_port')
            ->add('technique')
            ->add('distance')
            ->add('go_marine')
            ->add('essence')
            ->add('start_datetime')
            ->add('end_datetime')
            ->add('personnel')
            ;
    }
}
