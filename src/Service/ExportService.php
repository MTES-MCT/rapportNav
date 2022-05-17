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
        $containControleNavire = false;

        if(!$rapport) {
            throw new RapportNotFound("Le rapport n'a pas été trouvé.");
        }

        $templateProcessor = new TemplateProcessor(dirname(__DIR__) . '/Service/samples/SAMPLE_Rapport_mission_ULAM.docx');

        $templateProcessor->setValues([
            'dateDebut' => $rapport->getDateDebutMission()->format('d/m/Y'),
            'heureDebut' => $rapport->getDateDebutMission()->format('H:m'),
            'dateFin' => $rapport->getDateFinMission()->format('d/m/Y'),
            'heureFin' => $rapport->getDateFinMission()->format('H:m'),
            'missionArme' => $rapport->getArme() ? 'La mission était armé' : "La mission n'était pas armé",
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
            'controleCroise' => $rapport->getRepartitionHeures()->getControleCroise(),
            'immigration' => $rapport->getRepartitionHeures()->getImmigration(),
            'visiteSecurite' => $rapport->getRepartitionHeures()->getVisiteSecurite(),
            'surveillanceManifestationMer' => $rapport->getRepartitionHeures()->getSurveillanceManifestationMer() / 60,
            'surveillanceManifestationTerre' => $rapport->getRepartitionHeures()->getSurveillanceManifestationTerre() / 60,
            'surveillanceDpmMer' => $rapport->getRepartitionHeures()->getSurveillanceDpmMer() / 60,
            'surveillanceDpmTerre' => $rapport->getRepartitionHeures()->getSurveillanceDpmTerre() / 60,
            'surete' => $rapport->getRepartitionHeures()->getSurete(),
            'maintientOrdre' => $rapport->getRepartitionHeures()->getMaintienOrdre(),
            'assistance' => $rapport->getRepartitionHeures()->getAssistance(),
            'plongee' => $rapport->getRepartitionHeures()->getPlongee(),
            'nombreVisiteSecurite' => $rapport->getRepartitionHeures()->getNombreVisiteSecurite(),
            'commentaires' => $rapport->getCommentaire()

        ]);
        foreach($rapport->getAgents() as $agent) {
            $templateProcessor->replaceBlock('agent_list', $agent->getPrenom());
        }

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

        $tableControlesEtablissements = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 *50, 'unit' => TblWidth::PERCENT]);
        $tableControlesEtablissements->addRow();
        $tableControlesEtablissements->addCell(600)->addText('Etablissement');
        $tableControlesEtablissements->addCell(600)->addText('Date du contrôle');
        $tableControlesEtablissements->addCell(600)->addText('Sanction(s)');
        $tableControlesEtablissements->addCell(600)->addText('Commentaires');
        $totalEtablissementControles = 0;
        $commentaireEtablissement = null;

        $tableControlePechePied = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableControlePechePied->addRow();
        $tableControlePechePied->addCell(300)->addText('Pêcheur à pied');
        $tableControlePechePied->addCell(300)->addText('Statut du pêcheur');
        $tableControlePechePied->addCell(300)->addText('Contrôles');
        $tableControlePechePied->addCell(300)->addText('Sanction(s)');
        $tableControlePechePied->addCell(300)->addText('Commentaires');
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

                        $tableControlesEtablissements->addCell(600)->addText($controle->getPv());
                        $tableControlesEtablissements->addCell(600)->addText($controle->getCommentaire());
                    }

                    /** @var ControlePecheurPied $controle */
                    if($controle instanceof ControlePecheurPied) {
                        $commentairePechePied = $controle->getActivite()->getCommentaire();
                        $totalControlePechePied += 1;
                        $tableControlePechePied->addRow();
                        $tableControlePechePied->addCell(300)->addText($controle->getPecheurPied());
                        $tableControlePechePied->addCell(300)->addText($controle->getPecheurPied()->getEstPro() ? 'Professionnel' : 'Plaisancier');
                        $tableControlePechePied->addCell(300)->addText($controle->getDate()->format('d/m/Y'));
                        $tableControlePechePied->addCell(300)->addText($controle->getPv() ? 'PV : oui' : 'PV: non');
                        $tableControlePechePied->addCell(300)->addText($controle->getCommentaire());
                    }

                    /** @var ControleLoisir $controle */
                    if($controle instanceof ControleLoisir) {
                        $commentaireLoisurNautique = $controle->getActivite()->getCommentaire();
                        $totalControleLoisirNautique += 1;
                        $tableControleLoisirsNautiques->addRow();
                        $tableControleLoisirsNautiques->addCell(300)->addText($controle->getLoisir()->getNom());
                        $tableControleLoisirsNautiques->addCell(300)
                            ->addListItem('Total contrôles : ' . $controle->getNombreControleAireProtegee());
                        $tableControleLoisirsNautiques->addCell(300)->addText($controle->getNombrePv() > 0 ? 'PV : oui' : 'PV : non');
                        $tableControleLoisirsNautiques->addCell(300)->addText($controle->getCommentaire());
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


            if($totalControlesNavires > 0) {
                $templateProcessor->setValue('commentairesControlesNavires', $commentaireNavire);
                $templateProcessor->setComplexBlock('tableControlesNavires', $tableControleNavire);
                $templateProcessor->setValue('totalControlesNavires', $totalControlesNavires);
            }
            if($totalEtablissementControles > 0) {
                $templateProcessor->setValue('commentairesControlesEtablissements', $commentaireEtablissement);
                $templateProcessor->setComplexBlock('tableControlesEtablissements', $tableControlesEtablissements);
                $templateProcessor->setValue('totalEtablissementsControles', $totalEtablissementControles);
            }

            if($totalControlePechePied > 0) {
                $templateProcessor->setValue('commentairesControlePechePied', $commentairePechePied);
                $templateProcessor->setComplexBlock('tableControlesDetailPechePied', $tableControlePechePied);
                $templateProcessor->setValue('totalControlePechePied', $totalControlePechePied);
            }

            if($totalControleLoisirNautique > 0) {
                $templateProcessor->setValue('commentaireControleLoisirNautique', $commentaireLoisurNautique);
                $templateProcessor->setComplexBlock('tableControlesLoisirsNautiques', $tableControleLoisirsNautiques);
                $templateProcessor->setValue('totalControleLoisirNautique', $totalControleLoisirNautique);
            }

            if($totalAutreTypeControles > 0) {
                $templateProcessor->setValue('totalAutreTypeControles', $totalAutreTypeControles);
                $templateProcessor->setValue('lieuxAutreTypeControles', $lieuxAutreTypeControles);
                $templateProcessor->setValue('commentaireAutreTypeControles', $commentaireAutreTypeControle);
            }
       }

        $templateProcessor->setComplexBlock('tableActivitesAdministratives', $tableActivitesAdministratives);
        $templateProcessor->setValue('totalActivitesAdministratives', $totalActivitesAdministratives);


        return $templateProcessor;
    }

}
