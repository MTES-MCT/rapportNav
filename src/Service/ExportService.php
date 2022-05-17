<?php

namespace App\Service;

use App\Entity\ActiviteAdministratif;
use App\Entity\ActiviteFormation;
use App\Entity\ControleAutre;
use App\Entity\ControleEtablissement;
use App\Entity\ControleLoisir;
use App\Entity\ControleNavire;
use App\Entity\ControlePecheurPied;
use App\Exception\RapportNotFound;
use App\Repository\RapportRepository;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportService {

    /**
     * @var RapportRepository
     */
    private $rapportRepository;

    public function __construct(RapportRepository $rapportRepository)
    {
        $this->rapportRepository = $rapportRepository;
    }

    public function getDataForExport($id)
    {
        $rapport = $this->rapportRepository->find($id);

        if(!$rapport) {
            throw new RapportNotFound("Le rapport n'a pas été trouvé.");
        }

        $templateProcessor = new TemplateProcessor(dirname(__DIR__) . '/Service/samples/SAMPLE_Rapport_mission_ULAM.docx');

        $templateProcessor->setValues([
            'dateDebut' => $rapport->getDateDebutMission()->format('d/m/Y'),
            'heureDebut' => $rapport->getDateDebutMission()->format('H:m'),
            'dateFin' => $rapport->getDateFinMission()->format('d/m/Y'),
            'heureFin' => $rapport->getDateFinMission()->format('H:m'),
            'missionArme' => $rapport->getArme() ? 'La mission était armée.' : "La mission n'était pas armée.",
            'controleMer' => $rapport->getRepartitionHeures()->getControleMer() / 60,
            'controleTerre' => $rapport->getRepartitionHeures()->getControleTerre() / 60,
            'controleAerien' => $rapport->getRepartitionHeures()->getControleAerien() / 60,
            'controleAireProtegeeMer' => $rapport->getRepartitionHeures()->getControleAireProtegeeMer() / 60,
            'controleAireProtegeeTerre' => $rapport->getRepartitionHeures()->getControleAireProtegeeTerre() / 60,
            'controleAireProtegeeAerien' => $rapport->getRepartitionHeures()->getControleAireProtegeeAerien() / 60,
            'controlePollutionMer' => $rapport->getRepartitionHeures()->getControlePollutionMer() / 60,
            'controlePollutionTerre' => $rapport->getRepartitionHeures()->getControlePollutionTerre() / 60,
            'controlePollutionAerien' => $rapport->getRepartitionHeures()->getControlePollutionAerien() / 60,
            'controleEnvironnementMer' => $rapport->getRepartitionHeures()->getControleEnvironnementMer() / 60,
            'controleEnvironnementTerre' => $rapport->getRepartitionHeures()->getControleEnvironnementTerre() / 60,
            'controleEnvironnementAerien' => $rapport->getRepartitionHeures()->getControleEnvironnementAerien() / 60,
            'controleChlordeconeTotalMer' => $rapport->getRepartitionHeures()->getControleChlordeconeTotalMer() / 60,
            'controleChlordeconeTotalTerre' => $rapport->getRepartitionHeures()->getControleChlordeconeTotalTerre() / 60,
            'controleChlordeconePartielMer' => $rapport->getRepartitionHeures()->getControleChlordeconePartielMer() / 60,
            'controleChlordeconePartielTerre' => $rapport->getRepartitionHeures()->getControleChlordeconePartielTerre() / 60,
            'controleCroise' => $rapport->getRepartitionHeures()->getControleCroise() / 60,
            'immigration' => $rapport->getRepartitionHeures()->getImmigration() / 60,
            'visiteSecurite' => $rapport->getRepartitionHeures()->getVisiteSecurite() / 60,
            'surveillanceManifestationMer' => $rapport->getRepartitionHeures()->getSurveillanceManifestationMer() / 60,
            'surveillanceManifestationTerre' => $rapport->getRepartitionHeures()->getSurveillanceManifestationTerre() / 60,
            'surveillanceDpmMer' => $rapport->getRepartitionHeures()->getSurveillanceDpmMer() / 60,
            'surveillanceDpmTerre' => $rapport->getRepartitionHeures()->getSurveillanceDpmTerre() / 60,
            'surete' => $rapport->getRepartitionHeures()->getSurete() / 60,
            'maintientOrdre' => $rapport->getRepartitionHeures()->getMaintienOrdre() / 60,
            'assistance' => $rapport->getRepartitionHeures()->getAssistance() / 60,
            'plongee' => $rapport->getRepartitionHeures()->getPlongee() / 60,
            'nombreVisiteSecurite' => $rapport->getRepartitionHeures()->getNombreVisiteSecurite(),
            'commentaires' => $rapport->getCommentaire(),
            'missionAvecService' => $rapport->getServiceConjoints()->count() > 0 ? 'La mission était une mission conjointe avec le ou les services suivants : ' : 'La mission n’était pas réalisée avec d’autres services.',
        ]);


        if($rapport->getServiceConjoints()->count() > 0) {
            $tableServicesConjoints = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 6000, 'unit' => TblWidth::TWIP]);
            $tableServicesConjoints->addRow();
            $tableServicesConjoints->addCell(900)->addText('Nom du service');
            foreach($rapport->getServiceConjoints() as $serviceConjoint) {
                $tableServicesConjoints->addRow();
                $tableServicesConjoints->addCell(900)->addText($serviceConjoint->getNom());
            }

            $templateProcessor->setComplexBlock('table_services', $tableServicesConjoints);
        } else {
            $templateProcessor->setValue('table_services', ''); // remove macro
        }

        $templateProcessor->setValues([
            'block_services' => '',
            '/block_services' => ''
        ]); // remove macros


        $tableAgents = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 6000, 'unit' => TblWidth::TWIP]);
        $tableAgents->addRow();
        $tableAgents->addCell(800)->addText('Nom');
        $tableAgents->addCell(800)->addText('Prénom');
        foreach($rapport->getAgents() as $agent) {
            $tableAgents->addRow();
            $tableAgents->addCell(500)->addText($agent->getNom());
            $tableAgents->addCell(500)->addText($agent->getPrenom());
        }

        $templateProcessor->setComplexBlock('agent_list', $tableAgents);

        $tableControleNavire = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControleNavire->addRow();
        $tableControleNavire->addCell(600)->addText('Immatriculation');
        $tableControleNavire->addCell(600)->addText('Informations');
        $tableControleNavire->addCell(600)->addText('Contrôles réalisés');
        $tableControleNavire->addCell(600)->addText('Date/lieu de contrôle');
        $tableControleNavire->addCell(600)->addText('Sanction(s)');
        $tableControleNavire->addCell(600)->addText('Commentaires');
        $commentaireNavire = null;
        $totalControlesNavires = 0;

        $tableControlesEtablissements = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControlesEtablissements->addRow();
        $tableControlesEtablissements->addCell(600)->addText('Etablissement');
        $tableControlesEtablissements->addCell(600)->addText('Date du contrôle');
        $tableControlesEtablissements->addCell(600)->addText('Sanction(s)');
        $tableControlesEtablissements->addCell(600)->addText('Commentaires');
        $totalEtablissementControles = 0;
        $commentaireEtablissement = null;

        $tableControlePechePied = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControlePechePied->addRow();
        $tableControlePechePied->addCell(600)->addText('Pêcheur à pied');
        $tableControlePechePied->addCell(600)->addText('Statut du pêcheur');
        $tableControlePechePied->addCell(600)->addText('Contrôles');
        $tableControlePechePied->addCell(600)->addText('Sanction(s)');
        $tableControlePechePied->addCell(600)->addText('Commentaires');
        $totalControlePechePied = 0;
        $commentairePechePied = null;


        $tableControleLoisirsNautiques = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableControleLoisirsNautiques->addRow();
        $tableControleLoisirsNautiques->addCell(300)->addText('Loisir nautique');
        $tableControleLoisirsNautiques->addCell(300)->addText('Contrôles');
        $tableControleLoisirsNautiques->addCell(300)->addText('Sanction(s)');
        $tableControleLoisirsNautiques->addCell(300)->addText('Commentaires');
        $totalControleLoisirNautique = 0;
        $commentaireLoisurNautique = null;


        $tableActivitesAdministratives = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableActivitesAdministratives->addRow();
        $tableActivitesAdministratives->addCell(300)->addText('Tâche');
        $tableActivitesAdministratives->addCell(300)->addText('Durée');
        $tableActivitesAdministratives->addCell(300)->addText('Commentaire');

        $totalAutreTypeControles = 0;
        $lieuxAutreTypeControles = null;
        $commentaireAutreTypeControle = null;

        $totalActivitesAdministratives = 0;
        $lieuxFormations = null;

        $predefinedMultilevelStyle = ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED];


        foreach($rapport->getActivites() as $activite) {

            if($activite->getControles()) {
                foreach($activite->getControles() as $controle) {
                    /** @var ControleNavire $controle */
                    if($controle instanceof ControleNavire) {
                        $commentaireNavire = $controle->getActivite()->getCommentaire();
                        $totalControlesNavires += 1;
                        $tableControleNavire->addRow();
                        $tableControleNavire->addCell(600)->addText($controle->getNavire()->getImmatriculation());
                        $informationCell = $tableControleNavire->addCell(600);
                        $informationCell->addListItem('Pavillon : ' . $controle->getNavire()->getPavillon(), 0, null, $predefinedMultilevelStyle);
                        $informationCell->addListItem('Nom : ' . $controle->getNavire()->getNom());
                        $informationCell->addListItem('Longueur : ' . $controle->getNavire()->getLongueurHorsTout());
                        $informationCell->addListItem('Type : ' . $controle->getNavire()->getGenreNav());
                        $informationCell->addListItem('Catégorie : ' . $controle->getNavire()->getCategorieUsageNavire()->getNom());

                        $controlesRealisesCell = $tableControleNavire->addCell(600);

                        foreach($controle->getControleNavireRealises() as $controleNavireRealise) {
                            $controlesRealisesCell->addListItem($controleNavireRealise);
                        }

                        $tableControleNavire->addCell(600)->addText($controle->getDate()->format('d/m/Y'));

                        $sanctionsCell = $tableControleNavire->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }

                        if($controle->getDeroutement()) {
                            $sanctionsCell->addText($controle->getDeroutement()->getNom());
                        }

                        $tableControleNavire->addCell(600)->addText($controle->getCommentaire());
                    }

                    /** @var ControleEtablissement $controle */
                    if($controle instanceof ControleEtablissement) {
                        $lieux = null;
                        $commentaireEtablissement = $controle->getActivite()->getCommentaire();
                        $totalEtablissementControles += 1;
                        foreach($controle->getActivite()->getZones() as $zone) {
                            $lieux = $lieux . ' / ' . $zone->getNom();
                        }

                        $tableControlesEtablissements->addRow();
                        $informationCell = $tableControlesEtablissements->addCell(600);
                        $informationCell->addText('Nom : ' . $controle->getEtablissement()->getNom());
                        $informationCell->addText('Nom : ' . $controle->getEtablissement()->getAdresse());
                        $informationCell->addText('Nom : ' . $controle->getEtablissement()->getType()->getNom());
                        $tableControlesEtablissements->addCell(600)->addText($controle->getDate()->format('d/m/Y'));

                        $sanctionsCell = $tableControlesEtablissements->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }
                        $tableControlesEtablissements->addCell(600)->addText($controle->getCommentaire());
                    }


                    /** @var ControlePecheurPied $controle */
                    if($controle instanceof ControlePecheurPied) {
                        $controleProSansPv = $controle->getActivite()->getControleProSansPv();
                        $controlePlaisanceSansPv = $controle->getActivite()->getControlePlaisanceSansPv();

                        $nbControlesPechePiedPro = $controleProSansPv->getNombreControle();
                        $nbControleAMPPechePiedPro = $controleProSansPv->getNombreControleAireProtegee();
                        $nbControleChlordeconeTotalePechePiedPro = $controleProSansPv->getNombreControleChlordeconeTotale();
                        $nbControleChlordeconePartiellePechePiedPro = $controleProSansPv->getNombreControleChlordeconePartiel();

                        $nbControlesPechePiedPlaisance = $controlePlaisanceSansPv->getNombreControle();
                        $nbControleAMPPechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleAireProtegee();
                        $nbControleChlordeconeTotalePechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleChlordeconeTotale();
                        $nbControleChlordeconePartiellePechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleChlordeconePartiel();

                        $templateProcessor->setValues([
                            'nbControlesPecheursPlaisance' => $nbControlesPechePiedPlaisance,
                            'nbControlesPecheursPro' => $nbControlesPechePiedPro,
                            'nbControlesAMPPlaisance' => $nbControleAMPPechePiedPlaisance,
                            'nbControlesAMPPro' => $nbControleAMPPechePiedPro,
                            'nbControlesChlordeconeTotalePlaisance' => $nbControleChlordeconeTotalePechePiedPlaisance,
                            'nbControlesChlordeconeTotalePro' => $nbControleChlordeconeTotalePechePiedPro,
                            'nbControlesChlordeconePartielPlaisance' => $nbControleChlordeconePartiellePechePiedPlaisance,
                            'nbControlesChlordeconePartielPro' => $nbControleChlordeconePartiellePechePiedPro
                        ]);

                        $commentairePechePied = $controle->getActivite()->getCommentaire();
                        $totalControlePechePied += 1;
                        $tableControlePechePied->addRow();
                        $tableControlePechePied->addCell(600)->addText($controle->getPecheurPied());
                        $tableControlePechePied->addCell(600)->addText($controle->getPecheurPied()->getEstPro() ? 'Professionnel' : 'Plaisancier');
                        $controlesCell = $tableControlePechePied->addCell(600);
                        $controlesCell->addText('Date : ' . $controle->getDate()->format('d/m/Y'));
                        $controlesCell->addListItem( $controle->getTerrestre() ? 'Réalisé à terre' : 'Réalisé en mer');

                        if($controle->getAireProtegee()) {
                            $controlesCell->addListItem('Contrôle en AMP');
                        }
                        if($controle->getChloredeconeTotal()) {
                            $controlesCell->addListItem('Contrôle en zone Chloredecone total');
                        }

                        if($controle->getChloredeconeTotal()) {
                            $controlesCell->addListItem('Contrôle en zone Chloredecone partielle');
                        }


                        $sanctionsCell = $tableControlePechePied->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }


                        $tableControlePechePied->addCell(600)->addText($controle->getCommentaire());
                    }

                    /** @var ControleLoisir $controle */
                    if($controle instanceof ControleLoisir) {
                        $commentaireLoisurNautique = $controle->getActivite()->getCommentaire();
                        $totalControleLoisirNautique += 1;
                        $tableControleLoisirsNautiques->addRow();
                        $tableControleLoisirsNautiques->addCell(600)->addText($controle->getLoisir()->getNom());
                        $controlesCell = $tableControleLoisirsNautiques->addCell(600);
                        $controlesCell->addText('Nombre total de contrôles : ');
                        $controlesCell->addText('dont en AMP : ' . $controle->getNombreControleAireProtegee());
                        $controlesCell->addText('Nombre de PV : ' . $controle->getNombrePv());

                        $sanctionsCell = $tableControleLoisirsNautiques->addCell(600);
                        $sanctionsCell->addText($controle->getNombrePv() > 0 ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }

                        $tableControleLoisirsNautiques->addCell(600)->addText($controle->getCommentaire());
                    }

                    /** @var ControleAutre $controle */
                    if($controle instanceof ControleAutre) {
                        $commentaireAutreTypeControle = $controle->getActivite()->getCommentaire();
                        $totalAutreTypeControles += 1;

                        foreach($controle->getActivite()->getZones() as $zone) {
                            $lieuxAutreTypeControles = $zone;
                        }
                    }
                }
            }


            /** @var ActiviteAdministratif $activite */
            if($activite instanceof ActiviteAdministratif) {
                foreach($activite->getTaches() as $tache) {
                    $totalActivitesAdministratives += 1;
                    $tableActivitesAdministratives->addCell(300)->addText($tache->getTache()->getNom());
                    $tableActivitesAdministratives->addCell(300)->addText($tache->getDureeTache());
                    $tableActivitesAdministratives->addCell(300)->addText($tache->getCommentaire());
                }
            }

            /** @var ActiviteFormation $activite */
            if($activite instanceof ActiviteFormation) {
                $templateProcessor->setValue('formateur', $activite->getFormateur() ? 'Formateur' : 'stagiaire');
                $templateProcessor->setValue('commentaireFormateur', $activite->getCommentaire());
            }
       }

        if($totalControlesNavires > 0) {
            $templateProcessor->setComplexBlock('tableControlesNavires', $tableControleNavire);
            $templateProcessor->setValues([
                'block_controles_navires' => '',
                '/block_controles_navires' => '',
                'commentairesControlesNavires' => $commentaireNavire
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_navires', 0, true, true);
        }

        if($totalEtablissementControles > 0) {
            $templateProcessor->setComplexBlock('tableControlesEtablissements', $tableControlesEtablissements);
            $templateProcessor->setValues([
                'block_controles_etablissements' => '',
                '/block_controles_etablissements' => '',
                'commentairesControlesEtablissements' => $commentaireEtablissement
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_etablissements', 0, true, true);
        }

        if($totalControlePechePied > 0) {
            $templateProcessor->setComplexBlock('tableControlesDetailPechePied', $tableControlePechePied);
            $templateProcessor->setValues([
                'block_controles_peche_pied' => '',
                '/block_controles_peche_pied' => '',
                'commentairesControlePechePied' => $commentairePechePied
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_peche_pied', 0, true, true);
        }

        if($totalControleLoisirNautique > 0) {
            $templateProcessor->setComplexBlock('tableControlesLoisirsNautiques', $tableControleLoisirsNautiques);
            $templateProcessor->setValues([
                'block_controles_loisirs_nautiques' => '',
                '/block_controles_loisirs_nautiques' => '',
                'commentaireControleLoisirNautique' => $commentaireLoisurNautique
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_loisirs_nautiques', 0, true, true);
        }

        if($totalAutreTypeControles > 0) {
            $templateProcessor->setValue('lieuxAutreTypeControles', $lieuxAutreTypeControles);
            $templateProcessor->setValues([
                'block_autre_controles' => '',
                '/block_autre_controles' => '',
                'commentairesControlesNavires' => $commentaireAutreTypeControle
            ]);
        } else {
            $templateProcessor->cloneBlock('block_autre_controles', 0, true, true);
        }

        if($totalActivitesAdministratives > 0) {
            $templateProcessor->setComplexBlock('tableActivitesAdministratives', $tableActivitesAdministratives);
            $templateProcessor->setValues([
                'block_activites_administratives' => '',
                '/block_activites_administratives' => ''
            ]);
        } else {
            $templateProcessor->cloneBlock('block_activites_administratives', 0, true, true);
        }



        $templateProcessor->setValues([
            'totalActivitesAdministratives' => $totalActivitesAdministratives,
            'totalControlesNavires' => $totalControlesNavires,
            'totalAutreTypeControles' => $totalAutreTypeControles,
            'totalControlePechePied' => $totalControlePechePied,
            'totalEtablissementsControles' => $totalEtablissementControles,
            'totalControleLoisirNautique' => $totalControleLoisirNautique
        ]);

        return $templateProcessor;
    }

}
